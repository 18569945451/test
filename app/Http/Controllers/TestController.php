<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\WebServices\TestServices;

class TestController extends Controller
{

    public $service;

    public function __construct()
    {
        $this->service = new TestServices();
    }

    public function index(Request $request)
    {
        $data = $this->service->test($request);
        echo '<pre>';
        print_r($data);
        echo '<pre>';
    }
}