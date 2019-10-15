<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2019/9/27
 * Time: 11:17
 */

namespace App\Services\WebServices;

use App\Http\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class RoleService
{
    public $model;

    public function __construct()
    {
        $this->model = new Role();
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

        $this->model->name = $request->name;
        $this->model->display = Role::$status[$request->display];
        $this->model->save();
        return true;
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

        $data['permissions'] = $request->permissions;
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