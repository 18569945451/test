<?php
namespace App\Services\WebServices;

use Illuminate\Http\Request;
use App\Http\Models\Hobby;

class TestServices
{

    public $model;
    public function __construct()
    {
        $this->model = new Hobby();
    }

    public function search()
    {
        $limit      = request('limit', 15);
        $offset     = (request('page', 1) - 1) * $limit;
        $orderField = request('sort', 'id');
        $order      = request('order', 'DESC');
        $keyword    = request('keyword');

        $condition = $this->model
            ->when($keyword,function($query)use($keyword){
                return $query->where('name','like',"%{$keyword}%");
            });

        $count = $condition->count();
        $data  = $condition->offset($offset)->limit($limit)->orderBy($orderField,$order)->get();
        return [
            'code'  => 0,
            'msg'   => '',
            'total' => $count,
            'rows'  => $data,
        ];
    }
}