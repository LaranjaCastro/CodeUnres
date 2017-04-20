<?php

namespace App\Http\Controllers\Web\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Web\Weibo;
use App\Http\Model\Web\Page\Page;
use App\Http\Model\Web\Recommend;
use App\Http\Model\Web\Tools\Tools;
use App\Http\Model\Web\Tools\ArticleProcess;
use DB;

class Index extends Controller
{
    private $tableRecommend;
    private $tableWeibo;

    public function __construct()
    {
        $this->tableRecommend = new Recommend();
        $this->tableWeibo = new Weibo();
    }

    public function index($pageNow = false)
    {
        $currentPage = 1;
        if (is_numeric($pageNow)) {
            $currentPage = $pageNow;
        }

        $cond = array(
            'state' => 0,
            'recommend' => 1,
        );
        $page = new Page();
        $data = $page->setPage($currentPage)
                        ->setPageSize(2)
                        ->setModel($this->tableWeibo)
                        ->setCountMethod('getCount')
                        ->setListMethod('getList')
                        ->setCondtion($cond)
                        ->setSort(array('create_time' => 'DESC'))
                        ->setField()
                        ->getData();
        $data = json_decode(json_encode($data),true);

        $articleProcess = new ArticleProcess();
        $data['list'] = $articleProcess->processDescription($data['list']);

        $domain = '/page/';

        return view('web.frontend.index', array('content' => $data, 'domain' => $domain));
    }
}
