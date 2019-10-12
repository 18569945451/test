<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2019/9/27
 * Time: 11:17
 */

namespace App\Services\WebServices;

use App\Http\Models\Permission;
use App\Transformers\Goods\GoodsShowTransformer;
use App\Transformers\Goods\GoodsListTransformer;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class PermissionService
{
    public $model;

    public function __construct()
    {
        $this->model = new Permission();
    }

    /**
     * 商户美食列表
     * @return array
     */
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

    /**
     * 商户美食添加
     * @param $request
     */
    public function add($request)
    {
            //获取登陆的商户id
            $merchant_id = auth()->user()->id;
            $this->model->permissions = $request->permissions;
            $this->model->save();
            return true;

    }

    /**
     * 商户美食修改界面数据
     * @param $id
     * @return mixed
     */
    public function showData($id)
    {
        //获取登陆的商户id
        $merchant_id = auth()->user()->id;
        $data = $this->model->where('merchant_id',$merchant_id)->find($id);
        return $data;

    }

    /**
     * 商户美食修改
     * @param $request
     * @param $id
     */
    public function edit($request,$id)
    {
        try{
            //获取登陆的商户id
            $merchant_id = auth()->user()->id;

            if ($request->hasFile('images')){
                $data['images'] = json_encode(saveImageResource($request->file('images')));
            }

            $data['name'] = $request->name;
            $data['price'] = $request->price;
            $data['category_id'] = $request->category_id;

            $this->model->where('merchant_id',$merchant_id)->where('id',$id)->update($data);
            return true;
        }catch (QueryException $exception){
            throw ValidationException::withMessages(["Data error"]);
        }

    }

    /**
     * 展示页面
     * @param $id
     * @return mixed
     */
    public function showList($id)
    {
        $data = $this->model->with('category')->find($id);
        return (new GoodsShowTransformer)->transform($data);
    }

    /**
     * 商户美食删除
     * @param $request
     */
    public function destroy($id)
    {
        try{
            $this->model::destroy($id);
            return true;
        }catch (QueryException $exception){
            throw ValidationException::withMessages(["Data error"]);
        }
    }



}