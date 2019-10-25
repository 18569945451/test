<?php
/**
 * Created by PhpStorm.
 * Admins: wangxiao
 * Date: 2019/9/27
 * Time: 11:17
 */

namespace App\Services\WebServices;

use App\Models\Admins;
use App\Models\RoleAdmin;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\Http\Transformers\Admin\IndexTransformer;
use Illuminate\Validation\ValidationException;

class AdminsService
{
    public $model;

    public function __construct()
    {
        $this->model = new Admins();
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
        $data  = $condition->offset($offset)->with(['roles'])->limit($limit)->orderBy($orderField,$order)->get();

        return [
            'code'  => 0,
            'msg'   => '',
            'total' => $count,
            'rows'  => (new IndexTransformer())->transform($data),
        ];
    }

    /**
     * 权限添加
     * @param $request
     */
    public function add($request)
    {
        //todo 判断用户是否存在
        $result = $this->model->where('name',$request->name)->where('email',$request->email)->first();

        if (!$result){
            throw ValidationException::withMessages(['email' => ['Email input error']]);
        }
        //todo 判断密码是否正确
        if ( ! Hash::check($request->password, $result->password)) {
            throw ValidationException::withMessages(['password' => ['Old password input error']]);
        }
        $data = [
            'admin_id' => $result->id,
            'role_id' => $request->role_id,
        ];

        RoleAdmin::insert($data);
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