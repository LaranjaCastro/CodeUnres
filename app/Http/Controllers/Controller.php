<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Session;
use Redis;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function returnAjsx($status, $msg)
    {
        return json_encode(array('status' => $status, 'msg' => $msg));
    }

    public static function exitAjsx($status, $msg)
    {
        exit(json_encode(array('status' => $status, 'msg' => $msg)));
    }
}
