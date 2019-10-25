<?php

namespace App\Api\V1\Test\Services;
use App\Api\V1\Test\Entities\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Prettus\Validator\Exceptions\ValidatorException;

class TestServices
{
    protected $model;

    public function __construct()
    {
        //$this->model = new Test();
    }

    /**
     * 普通注册
     * @param Request $request
     * @return bool
     */
    public function create(Request $request)
    {
        $token =auth('api')->attempt(['id'=>2]);
        print_r($token);exit;
        $result = true;

        /*if ($result){

            throw new ValidatorException(new MessageBag(["No repeat appointments"]));
        }*/
        $this->model->name      = $request->name;
        $this->model->email     = $request->email;
        $this->model->password  = Hash::make($request->password);
        $this->model->api_token     = Str::random(60);
        $this->model->photo     = Collection::make($request->file('photo'))->map(function ($item){
                    return saveImageResource($item);
        });

        $res = $this->model->save();
        return $res;
    }

    //查询
    public function select()
    {

    }

    //更新
    public function update()
    {

    }

    //删除
    public function delete()
    {

    }
}