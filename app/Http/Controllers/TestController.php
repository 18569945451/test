<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\WebServices\TestServices;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{

    public $service;

    public function __construct()
    {
        $this->service = new TestServices();
    }

    public function index(Request $request)
    {
        $credentials = ['email'=>'test@qq.com','password'=>123456789];
        //$credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            echo 111111111;exit;
            // 身份验证通过...
            return redirect()->intended('test');
        }
        $data = $this->service->test($request);
        echo '<pre>';
        print_r($data);
        echo '<pre>';
    }
}