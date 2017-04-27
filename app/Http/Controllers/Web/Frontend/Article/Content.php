<?php

namespace App\Http\Controllers\Web\Frontend\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Web\User;
use App\Http\Model\Web\Weibo;
use App\Http\Model\Web\Tools\Tools;
use App\Http\Model\Web\Tools\Scws;
use App\Http\Model\Web\Tools\ArticleProcess;
use DB;
use Session;
use Redis;

class Content extends Controller
{
    private $table;
    private $tableUser;
    public $redis;
    protected $toolsScws;
    protected $tools;

    public function __construct()
    {
        $this->table = new Weibo();
        $this->tableUser = new User();
        $this->redis = Redis::connection();
        $this->toolsScws = new Scws();
        $this->tools = new Tools();

    }

    public function index($category = false, $bookId = false)
    {
        $bookId = is_numeric((int)$bookId) ? (int)$bookId : 1;

        if (is_null($this->redis->get($bookId))) {
            $content = json_decode(json_encode($this->table->get(array('id' => $bookId))), true);
            if (! empty($content) ) {
                $content['markTime'] = Tools::getReleaseDate(time()-strtotime($content['create_time']));
                $content['create_time'] = date('Y-m-d H:i', strtotime($content['create_time']));

                $userInfo = $this->tableUser->get(array('id' => $content['user_id']), array('name'));
                $content['name'] = $userInfo->name;

                // 分词
                $participle = $this->toolsScws->getScws($content['title']);
                array_multisort(array_column($participle,'weight'),SORT_DESC,$participle);
                $word = array_column($participle,'word');
                if (count($participle) >= 2) {
                    $word = array_column(array($participle[0], $participle[1]),'word');
                }

                $relatedReading = json_decode(json_encode($this->tools->getParticipleTitle($word)), true);
                $articleProcess = new ArticleProcess();
                $relatedReading = $articleProcess->processDescription($relatedReading);

                if ($relatedReading) {
                    $relatedReadingTitle = array();
                    foreach ($relatedReading as $k => $v) {
                        if ($v['title'] != $content['title'] && count($relatedReadingTitle) <= 8) {
                            $relatedReadingTitle[$k]['title'] = $v['title'];
                            $relatedReadingTitle[$k]['url'] = $v['url'];
                        }
                    }
                }

                $this->redis->set($bookId, json_encode(array($content, $relatedReadingTitle)));
            }
        }

        list($content, $relatedReadingTitle) = json_decode($this->redis->get($bookId), true);

        return view('web.frontend.article.content', array('content' => $content, 'relatedReadingTitle' => $relatedReadingTitle));
    }
}
