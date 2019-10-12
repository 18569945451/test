<?php

namespace App\Http\Controllers;

use App\Services\WebServices\PermissionService;
use Illuminate\Http\Request;
use App\Http\Models\Role;

use Illuminate\Validation\ValidationException;

class PermissionController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new PermissionService();
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
        return view('Permission.index');
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('Permission.add');
    }

    /**
     *
     * @param  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        try{
            $this->service->add($request);
            return redirect('/permission/create')->withInput(['status'=>1]);
        }catch (ValidationException $exception){
            return apiReturn([],403,$exception->getMessage());
        }

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

    /**
     * 美食修改处理(自建路由)
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit_dispose(EditGoodsRequest $request,$id)
    {
        try{
            $this->service->edit($request,$id);
            return redirect('/Permission/'.$id)->withInput(['status'=>1]);
        }catch (ValidationException $exception){
            return apiReturn([],403,$exception->getMessage());
        }

    }

    /**
     * 美食show(自建路由)
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_list($id)
    {
        $data = $this->service->showList($id);
        return view('Permission.show',compact('data'));
    }

    /**
     * 美食删除处理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{
            $this->service->destroy($id);
            return apiReturn([]);
        }catch (ValidationException $exception){
            return apiReturn([],403,$exception->getMessage());
        }

    }

    public function myrole()
    {
        echo "已经进行到此处";exit;
        $roles = Role::get(); // 获取所有角色
        return view('Role.index')->with('roles', $roles);
    }
}
