<?php

namespace App\Http\Model\Web;

use Illuminate\Database\Eloquent\Model;
use DB;

class Menu extends Model
{

    protected $table = 'menu';
    public $timestamps = false;

    // 查询所有数据
    public function getAll(array $where = array(), array $fieled = null)
    {
        $select = DB::table('menu');
        if (! empty($fieled)) {
            $select->select($fieled);
        }
        $this->_refrom($where, $select);

        return $select->get();
    }

    public function get(array $where, array $fieled)
    {
        $select = DB::table('menu');
        if (! empty($fieled)) {
            $select->select($fieled);
        }
        $this->_refrom($where, $select);

        return $select->first();
    }

    public function _sort(array $where, &$select)
    {
        foreach ($where as $k => $v) {
            switch ($k) {
            }
        }
    }

    public function _refrom(array $where, &$select)
    {
        foreach ($where as $k => $v) {
            switch ($k) {
                case 'id':
                    $select->where('id', $v);
                    break;
            }
        }
    }

}
