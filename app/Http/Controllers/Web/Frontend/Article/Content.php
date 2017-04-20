<?php

namespace App\Http\Controllers\Web\Frontend\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Web\User;
use App\Http\Model\Web\Weibo;
use App\Http\Model\Web\Tools\Tools;
use DB;
use Session;

class Content extends Controller
{
    private $table;
    private $tableUser;

    public function __construct()
    {
        $this->table = new Weibo();
        $this->tableUser = new User();
    }

    public function index($category = false, $bookId = false)
    {
        $bookId = is_numeric((int)$bookId) ? (int)$bookId : 1;
        $content = json_decode(json_encode($this->table->get(array('id' => $bookId))), true);
        if (! empty($content)) {
            $content['markTime'] = Tools::getReleaseDate(time()-strtotime($content['create_time']));
            $content['create_time'] = date('Y-m-d H:i', strtotime($content['create_time']));

            $userInfo = $this->tableUser->get(array('id' => $content['user_id']), array('name'));
            $content['name'] = $userInfo->name;
        }
            return view('web.frontend.article.content', array('content' => $content));
    }
}
