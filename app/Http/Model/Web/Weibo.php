<?php

namespace App\Http\Model\Web;

use Illuminate\Database\Eloquent\Model;
use DB;

class Weibo extends Model
{
    protected $table = 'weibo';
    public $timestamps = false;

    // 查询所有文章
    public function getAll($where)
    {
        $select = DB::table('weibo')->leftJoin('user', 'weibo.user_id', '=', 'user.id')->select('weibo.*', 'user.name');
        $this->_refrom($where, $select);

        return $select->get()->toArray();
    }

    // 获取总数
    public function getCount($where)
    {
        $select = DB::table('weibo');
        $this->_refrom($where, $select);
        return $select->count();

    }

    // 获取一条数据
    public function get($where)
    {
        $select = DB::table('weibo')->select('*');
        $this->_refrom($where, $select);
        return $select->first();
    }

    // 更新数据
    public function updates($where, $data)
    {
        $select = DB::table('weibo');
        $this->_refrom($where, $select);
        return $select->update($data);
    }

    // 删除数据
    public function del($where)
    {
        $select = DB::table('weibo')->select('*');
        $this->_refrom($where, $select);
        return $select->delete();
    }

    // 获取所有数据
    public function getList($where, $page, $pageSize, $field, $orderBy)
    {
        $select = DB::table('weibo')->leftJoin('user', 'weibo.user_id', '=', 'user.id')->select('weibo.*', 'user.name');
        $this->_sortby($orderBy, $select);
        $this->_refrom($where, $select);
        return $select->skip($page)->take($pageSize)->get();
    }

    // 添加文章
    public function insertBook($data)
    {
        return DB::table('weibo')->insert($data);
    }

    public function _sortby(array $orderBy, &$select)
    {
        if (empty($orderBy)) {
            return false;
        }

        foreach ($orderBy as $k => $v) {
            switch ($k) {
                case 'create_time':
                    $select->orderBy('weibo.create_time', $v);
                    break;
            }
        }
    }

    public function _refrom(array $condtion, &$select)
    {
        foreach ($condtion as $k => $v) {
            switch ($k) {
                case 'category':
                    $select->where('category', $v);
                    break;
                case 'recommend':
                    $select->where('recommend', $v);
                    break;
                case 'state':
                    $select->where('weibo.state', $v);
                    break;
                case 'user_id':
                    $select->where('user_id', $v);
                    break;
                case 'id':
                    if (is_array($v)) {
                        $select->whereIn('id', $v);
                    } else {
                        $select->where('id', $v);
                    }
                    break;
            }
        }
    }
}
