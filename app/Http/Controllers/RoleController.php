<?php

namespace App\Http\Controllers;

use App\Services\WebServices\RoleService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class RoleController extends Controller
{
    public function __construct()
    {
        $this->service = new RoleService();
    }

    /**
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()){
            return $this->service->search();
        }
        return view('Role.index');
    }


    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('Role.add');
    }

    /**
     *
     * @param  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $this->service->add($request);
        return redirect('/role/create')->withInput(['status'=>1]);
    }

    /**
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $data = $this->service->showData($id);
        return view('Permission.edit',compact('data'));
    }


    public function edit_dispose(Request $request,$id)
    {
        try{
            $this->service->edit($request,$id);
            return redirect('/permission/'.$id)->withInput(['status'=>1]);
        }catch (ValidationException $exception){
            return apiReturn([],403,$exception->getMessage());
        }

    }




   /* //创建角色
    public  function  create(){
        $routes_groups = PermissionService::getAdminRoutesGroups();
//        dd($routes_groups);


        return view('admin.role.create',compact('routes_groups'));
    }
    //验证添加角色
    public function store(Request $request){
        $input = $request->all();
        //验证判断
        $rules = [
            'name'=>'required|unique:roles,name',
            'display'=>'required',
            'permissions'=>'required',
        ];
        $this->validate($request,$rules);
        $role = Role::create([
            'name'=>$input['name'],
            'display'=>$input['display'],
        ]);
        $role->permissions()->sync($input['permissions']);
        return redirect()->route('admin.role.index')->with('msg','添加成功!');
    }
    //编辑角色
    public function edit($id){
        $routes_groups = PermissionService::getAdminRoutesGroups();
        $role = Role::findOrFail($id);
        $permissions = $role->pivots()->pluck('permission_id')->all();
        return view('admin.role.edit',compact('role','routes_groups','permissions'));
    }
    //更新角色
    public  function   update(Request $request,$id){
        $role = Role::findOrFail($id);
        $input = $request->all();
        $rules = [
            'name' => 'required|unique:roles,name,' . $role->id,
            'display' => 'required',
            'permissions' => 'required',
        ];
        $this->validate($request, $rules);
        $role->name = $input['name'];
        $role->display = $input['display'];
        $role->save();
        $role->permissions()->sync($input['permissions'] ?? []);
        return redirect(route('admin.role.index'))->with('msg', '角色编辑成功');

    }
    //删除角色
    public function destroy(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->permissions()->detach();
        $role->forceDelete();

        return back()->with('msg', '角色删除成功');
    }

    private function getAdminRoutesGroups()
    {
        // 获取组名映射表
        $groups_map = PermissionService::getPermissionGroupsMap();

        // 获取或有路由
        $all_routes = app()['router']->getRoutes()->getRoutesByName();

        // 过滤总后台路由
        $admin_routes = array_filter($all_routes, function ($route) {
            return $route->getPrefix() === 'admin';
        });

        $routes_groups = [];


        // 按模块分组
        foreach ($admin_routes as $route) {
            $group = $route->action['group'] ?? false;

            // 过滤指定组
            if ($group && array_key_exists($group, $groups_map)) {
                $routes_groups[$group][] = $route;
            }
        }

        return $routes_groups;
    }*/

}
