<?php

namespace App\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Web\Backend;

class Site extends Controller
{
    public function tags()
    {
        return view('web.backend.site.tags');
    }
}
