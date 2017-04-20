<?php

namespace App\Http\Model\Web\Backend;

use Illuminate\Database\Eloquent\Model;
use DB;

class Weibo extends Model
{
    protected $table = 'weibo';
    public $timestamps = false;

    // 查询所有文章
    public function getAll()
    {
        return Weibo::all();
    }

    // 添加文章
    public function insertBook($data)
    {
        return DB::table('weibo')->insert($data);
    }
}
