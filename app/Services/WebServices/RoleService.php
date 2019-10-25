<?php

namespace App\Services\WebServices;

use App\Models\Role;
use App\Models\permissionRole;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use DB;
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
     * 角色权限添加
     * @param $request
     * @return bool
     */
    public function add($request)
    {
        DB::beginTransaction();
        try{
            $data = [
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description,
            ];
            //todo 获取角色表插入的id
            $insertId  = Role::insertGetId($data);
            $data = [];
            if ($insertId){
                //todo 循环加入的权限id
                foreach ($request->permissions_id as $key=>$item){
                    $data[$key] = [
                        'permission_id' => $item,
                        'role_id' => $insertId,
                    ];
                }

                //todo 把权限id 角色的id 插入到权限角色关联的表中（permission_role）
                $role = permissionRole::insert($data);

                if ($role){
                    DB::commit();
                    return true;
                }
            }

        }catch (\Exception $e){

            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();

        }

    }

    public function roleData()
    {
        return $this->model->get(['id','display_name']);
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