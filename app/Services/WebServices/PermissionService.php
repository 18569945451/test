<?php
/**
 * Created by PhpStorm.
 * Admins: wangxiao
 * Date: 2019/9/27
 * Time: 11:17
 */

namespace App\Services\WebServices;

use App\Permission;
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
     * 权限列表
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
        /*if (auth()->user()->can('admin.index.index')){

            $data['woc'] = 11111111;
        }*/
        return [
            'code'  => 0,
            'msg'   => '',
            'total' => $count,
            'rows'  => $data,
        ];
    }

    /**
     * 权限添加
     * @param $request
     */
    public function add($request)
    {
            $this->model->description = $request->description;
            $this->model->display_name = $request->display_name;
            $this->model->name = $request->name;
            $this->model->save();
            return true;
    }

    /**
     * 权限内容
     */
    public function permissionData()
    {
        return $this->model->get(['id','display_name']);
    }
    /**
     *
     * @param $id
     * @return mixed
     */
    public function showData($id)
    {
        $data = $this->model->find($id);
        return $data;
    }

    /**
     * 商户美食修改
     * @param $request
     * @param $id
     */
    public function edit($request,$id)
    {

        $data['name'] = $request->name;
        $data['display_name'] = $request->display_name;
        $data['description'] = $request->description;
        $this->model->where('id',$id)->update($data);
        return true;


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