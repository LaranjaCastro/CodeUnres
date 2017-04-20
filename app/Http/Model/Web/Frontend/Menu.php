<?php

namespace App\Http\Model\Web\Frontend;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = 'menu';
    public $timestamps = false;

    // 查询所有数据
    public function getAll()
    {
        return Menu::where('state', 0)->get()->toArray();
    }

}
