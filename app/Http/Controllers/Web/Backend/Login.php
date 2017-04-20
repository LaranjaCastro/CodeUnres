<?php

namespace App\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Http\Model\Web\Backend;
use Redirect, Session;

class Login extends Controller
{

    private $adminUser;
    const PASSWDSALT = 'leon';

    public function __construct()
    {
        $this->adminUser = new Backend\AdminUser();
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

            $checkUser = $this->adminUser->get($name);
            if (empty($checkUser) || (md5($passwd) != $checkUser['passwd'])) {
                return Login::returnAjsx(-100, '用户名或密码错误');
            }

            $request->session()->put('user', $checkUser);
            return Login::returnAjsx(200, '登陆成功');
        }

    }
}
