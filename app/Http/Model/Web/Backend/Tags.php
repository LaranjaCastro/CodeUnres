<?php

namespace App\Http\Model\Web\Backend;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';
    public $timestamps = false;

    public function get()
    {
        return Tags::all();
    }
}
