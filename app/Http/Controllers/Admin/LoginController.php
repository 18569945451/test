<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
        $this->username = config('admin.global.username');
    }

    /**
     * 重写登录视图页面
     */
    public function showLogin()
    {
        return view('admin.login.index');
    }

    /**
     * 自定义认证驱动
     * @return mixed
     */
    protected function guard()
    {
        return auth()->guard('admin');
    }


}