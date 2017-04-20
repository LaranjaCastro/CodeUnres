<?php

namespace App\Http\Model\Web;

use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model
{
    protected $table = 'user';
    public $timestamps = false;

    public function get(array $where, array $fieled = null)
    {
        $select = DB::table('user');
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
                case 'create_time':
                    $select->orderBy('create_time', $v);
                    break;
            }
        }
    }

    public function _refrom(array $where, &$select)
    {
        foreach ($where as $k => $v) {
            switch ($k) {
                case 'name':
                    $select->where('name', $v);
                    break;
                case 'user_id':
                    $select->where('user_id', $v);
                break;
                case 'mark':
                $select->where('mark', $v);
                break;
            }
        }
    }

}
