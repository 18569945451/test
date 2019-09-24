<?php
namespace App\Services\WebServices;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Test;
use App\Http\Models\Hobby;
use App\Http\Transformers\Test\TestTransformer;

class TestServices
{

    public $model;
    public function __construct()
    {
        $this->model = new Hobby();
    }

    public function test(Request $request)
    {
        //返回所有的集合元素
        $collection = collect([1, 2, 3])->all();
        //求集合的平均值
        $collection = collect([1, 2, 3])->avg();
        //把集合拆分为给定数量的小集合
        $collection = collect([1, 2, 3])->chunk(2)->toArray();
        //把多个集合合并成一个集合
        $collection = collect([[1, 2, 3],[4,5,6],[7,8,9]])->collapse()->toArray();
        //把第一个集合的值作为键，第二个集合的值作为值合并成一个集合
        $collection = collect([1, 2, 3])->combine(['a','b','c']);

        $collection = collect([1, 2, 3]);

        $collection->when(true, function ($collection) {
            return $collection->push(4);
        });
        /*$collection->unless(false, function ($collection) {
            return $collection->push(5);
        });*/
        //$collection->all();
        print_r($collection->all());exit;
        /*$test = $this->model;
        $result = $test
                    ->with(['posts'])
                    ->when($request->id > 0,function (){
                        return
                    })
                    ->get();
        echo '<pre>';
        print_r($result->toArray());exit;
        $test->where('id',$request->id)->get();
        print_r($test);exit;*/
    }
}