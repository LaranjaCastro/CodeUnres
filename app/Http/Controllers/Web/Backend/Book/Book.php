<?php

namespace App\Http\Controllers\Web\Backend\Book;

use App\Http\Model\Web\Weibo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Web;
use App\Http\Model\Web\Page\Page;
use App\Http\Model\Web\Tools\Tools;
use Session;
use DB;

class Book extends Controller
{

    private $menu;
    private $sessions;
    private $tableWeibo;

    public function __construct()
    {
        $this->menu = new Web\Menu();
        $this->tableWeibo = new Web\Weibo();

        $this->sessions = (object) array(
            'user' => (object) Session::get('user'),
        );
    }

    // 添加新文章页面
    public function index($bookId = false)
    {

        $signal = 'save'; $content = null;
        if (is_numeric($bookId)) {
            $bookContent = $this->tableWeibo->get(array('user_id' => $this->sessions->user->id, 'id' => $bookId));
            $content = json_decode(json_encode($bookContent), true);
            $signal = 'update';
        }

        $menus = $this->menu->getAll();
        $menus = json_decode(json_encode($menus), true);

        return view('web.backend.book.index', array('menu' => $menus, 'content' => $content, 'signal' => $signal));
    }

    // 更新文章页面
    public function update(Request $request)
    {
        $title = trim($request->input('title')) ?:
            Book::exitAjsx(-100, '标题不能为空');
        $content = trim($request->input('content')) ?:
            Book::exitAjsx(-100, '内容不能为空');
        $menu = trim($request->input('menu')) ?:
            Book::exitAjsx(-100, '分类不能为空');


        $upField['title'] = $title;
        $upField['content'] = $content;
        $upField['category'] = $menu;
        $upField['update_time'] = date('Y-m-d H:i:s');


        $bookId = $request->input('bookId');
        if ($bookId && is_numeric($bookId)) {
            $up = array('user_id' => $this->sessions->user->id, 'id' => $bookId);
            $upBook = $this->tableWeibo->updates($up, $upField);
            if ($upBook) {
                Book::exitAjsx(200, '更新成功');
            }
            Book::exitAjsx(-100, '更新失败');
        }
    }

    // 存入新文章
    public function news(Request $request)
    {
        $title = trim($request->input('title')) ?:
            Book::exitAjsx(-100, '标题不能为空');
        $content = trim($request->input('content')) ?:
            Book::exitAjsx(-100, '内容不能为空');
        $menu = trim($request->input('menu')) ?:
            Book::exitAjsx(-100, '分类不能为空');

        $weibo = new Web\Weibo();
        $insert = array(
            'user_id' => $this->sessions->user->id,
            'title' => $title,
            'category' => $menu,
            'content' => $content,
            'create_time' => date('Y-m-d H:i:s'),
            'update_time' => date('Y-m-d H:i:s'),
        );
        $save = $weibo->insertBook($insert);
        if (empty($save)) {
            Book::exitAjsx(-200, '文章添加失败');
        }

        Book::exitAjsx(200, '发布成功');
    }

    public function lists()
    {
        $cond = array(
            'state' => 0,
            'user_id' => $this->sessions->user->id,
        );
        $page = new Page();
        $data = $page->setPage(1)
            ->setPageSize(100)
            ->setModel($this->tableWeibo)
            ->setCountMethod('getCount')
            ->setListMethod('getList')
            ->setCondtion($cond)
            ->setSort(array('create_time' => 'DESC'))
            ->setField(array('id', 'title', 'category', 'create_time', 'recommend'))
            ->getData();
        $data = json_decode(json_encode($data),true);
        foreach ($data['list'] as $k => &$v) {
            $v['create_time'] = date('Y-m-d H:i', strtotime($v['create_time']));
            $v['url'] = 'http://www.leon.com/t/'. Tools::getCategoryName($v['category']) .'/'. $v['id'];
            $v['menu'] = Tools::getCategoryName($v['category']);
            $v['recommendMark'] = $v['recommend'] ? '已推荐' : '未推荐';
        }

        return view('web.backend.book.list', array('data' => $data));
    }

    // 设置推荐
    public function recommend(Request $request)
    {
        $bookId = trim($request->input('bookId'));
        $mark = trim($request->input('state'));
        $state = $stateName = null;


        if ((int)$mark === 0) {
            $state = 1;
            $stateName = '已推荐';
        } elseif ((int)$mark === 1) {
            $state = 0;
            $stateName = '未推荐';
        }


        if (($bookId && is_numeric($bookId)) && ($state !== null)) {
            $up = array('user_id' => $this->sessions->user->id, 'id' => $bookId);
            if ($this->tableWeibo->updates($up, array('recommend' => $state))) {
                Book::exitAjsx(200, $stateName);
            }
            Book::exitAjsx(-100, '更新失败');
        }

        Book::exitAjsx(-100, '数据异常');
    }

    public function del(Request $request)
    {
        if ($request->has('id')) {
            $id = (int)$request->input('id');
            if ($id && is_numeric($id)) {
                $checkUser = $this->tableWeibo->get(array('user_id' => $this->sessions->user->id, 'id' => $id));
                if (empty($checkUser)) {
                    Book::exitAjsx(-100, '该文章已不存在');
                }
                if ($this->tableWeibo->del(array('id' => $id))) {
                    Book::exitAjsx(200, '删除成功');
                }

                Book::exitAjsx(200, '删除失败');
            }
        }

        Book::exitAjsx(-100, '数据异常');
    }

}
