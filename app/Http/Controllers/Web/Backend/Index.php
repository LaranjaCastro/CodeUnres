<?php

namespace App\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class Index extends Controller
{
    public function index()
    {
        $userInfo = Session::get('user');

        return view('web.backend.index', array('user' => $userInfo));
    }
}
