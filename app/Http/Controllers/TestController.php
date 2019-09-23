<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Services\WebServices\TestServices;

class TestController extends Controller
{

    public $service;

    public function __construct()
    {
        $this->service = new TestServices();
    }

    public function index()
    {
        $data = $this->service->test();
        echo '<pre>';
        print_r($data);
        echo '<pre>';
    }
}