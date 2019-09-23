<?php
namespace App\Services\WebServices;

use App\Http\Models\Test;
use App\Http\Transformers\Test\TestTransformer;

class TestServices
{

    public $model;

    public function __construct()
    {
        $this->model = new Test();
    }
    public function test()
    {
        echo "<pre>";
        $phone = $this->model->find(1)->comments;
        print_r($phone->toArray());exit;
        /*$limit      = request('limit', 15);
        $offset     = (request('page', 1) - 1) * $limit;
        $orderField = request('field', 'code');
        $order      = request('order', 'DESC');

        $data = $this->model
            ->offset($offset)
            ->limit($limit)
            ->orderBy($orderField,$order)
            ->get();

        return [
            'code'  => 0,
            'msg'   => '',
            'count' => 1,
            'data'  => (new TestTransformer())->transform($data),
        ];*/
    }
}