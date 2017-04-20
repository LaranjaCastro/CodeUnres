<?php

namespace App\Http\Model\Web;

use Illuminate\Database\Eloquent\Model;
use DB;

class Recommend extends Model
{
    protected $table = 'recommend';
    public $timestamps = false;

    public function getAll(array $where, $field = false)
    {
        $select = DB::table($this->table);
        if (! empty($field)) {
            $select->select($field);
        }
        $this->_refrom($where, $select);
        return $select->get()->toArray();
    }

    public function _refrom(array $where, $select)
    {
        foreach ($where as $k => $v) {
            switch ($k) {
                case 'id':
                    $select->where('id', $v);
                    break;
                case 'state':
                    $select->where('state', $v);
                    break;
            }
        }
    }
}
