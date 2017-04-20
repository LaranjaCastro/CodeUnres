<?php

namespace App\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Http\Model\Web;
use Redirect, Session;

class Login extends Controller
{

    private $adminUser;
    const PASSWDSALT = 'leon';

    public function __construct()
    {
        $this->tableUser = new Web\User();
    }

    // 登录页
    public function index(Request $request)
    {
        return view('web.backend.login');
    }

    // 登陆
    public function signIn(Request $request)
    {
        if ($request->has('name')) {
            $name = $request->input('name');
            $passwd = self::PASSWDSALT . $request->input('passwd');

            $checkUser = $this->tableUser->get(array('name' => $name, 'mark' => 1));
            if (empty($checkUser)) {
                return Login::returnAjsx(-100, '该用户不存在');
            } elseif (md5($passwd) != $checkUser->passwd) {
                return Login::returnAjsx(-100, '用户名或密码错误');
            }

            $request->session()->put('user', json_decode(json_encode($checkUser), true));
            return Login::returnAjsx(200, '登陆成功');
        }

    }
}
