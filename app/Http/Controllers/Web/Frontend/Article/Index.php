<?php

namespace App\Http\Controllers\Web\Frontend\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Web;
use App\Http\Model\Web\Page\Page;
use App\Http\Model\Web\Tools\Tools;
use App\Http\Model\Web\Tools\ArticleProcess;

class Index extends Controller
{
    private $tableWeibo;

    public function __construct()
    {
        $this->tableWeibo = new Web\Weibo();
    }

    public function lists($menu, $pageMark = false, $num = false)
    {

        $menuId = Tools::getCategoryId($menu);
        if ($menuId) {
            $field = array('id', 'title', 'content', 'create_time', 'category');
            $page = new Page();
            $page->setPage(1)
                ->setPageSize(10)
                ->setCondtion(array('category' => $menuId))
                ->setModel($this->tableWeibo)
                ->setCountMethod('getCount')
                ->setField($field)
                ->setListMethod('getList');
            if ($pageMark == 'page' && is_numeric((int)$num)) {
                $page->setPage($num);
            }

            $articleProcess = new ArticleProcess();
            $content = json_decode(json_encode($page->getData()), true);
            $content['list'] = $articleProcess->processDescription($content['list']);

            $domain = '/'. $menu .'/page/';

            return view('web.frontend.article.index', array('content' => $content, 'domain' => $domain));
        }
    }

}
