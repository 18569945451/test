<?php

namespace App\Http\Controllers;

use App\Services\WebServices\AdminsService;
use App\Services\WebServices\RoleService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->service = new AdminsService();
        $this->middleware('auth.admin:admin');
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
        return view('Admin.index');
    }


    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data =(new RoleService)->roleData();

        return view('Admin.add',compact('data'));
    }

    /**
     *
     * @param  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $this->service->add($request);
        return redirect('/admin/create')->withInput(['status'=>1]);
    }

    /**
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $data = $this->service->showData($id);
        return view('Admin.edit',compact('data'));
    }


    public function edit_dispose(Request $request,$id)
    {
        try{
            $this->service->edit($request,$id);
            return redirect('/Admin/'.$id)->withInput(['status'=>1]);
        }catch (ValidationException $exception){
            return apiReturn([],403,$exception->getMessage());
        }

    }
    /*//管理员列表
    public  function index(){
        $search_items = [
            'name' => [
                'type' => 'like',
                'form' => 'text',
                'label' => '姓名',
            ],
            'mobile' => [
                'type' => 'like',
                'form' => 'text',
                'label' => '手机号',
            ],
            'created_at' => [
                'type' => 'date',
            ],
        ];
        $data = Admin::latest()
            ->search($search_items)
            ->paginate();
        $roles =Role::get();

        return view('admin.admin.index',compact('data','roles'));
    }
    //管理员编辑页面
    public function  edit(Request $request,$id){
        $data = Admin::with('roles')->findOrFail($id);
        $roles = Role::get();
        return view('admin.admin.edit',compact('data','roles'));
    }
    //管理员更新
    public function update(Request $request,$id){
        $admin = Admin::findOrFail($id);
        //进行验证
        $this->validate($request,[
            'mobile'=>'required|unique:admin,mobile'.$admin->id,
            'name'=>'required'
        ]);
        $admin->mobile = $request->get('mobile');
        $admin->name = $request->get('name');
        $admin->save();
        $admin->roles()->sync($request->get('roles'));

        return redirect()->route('admin.admin.index')->with('msg','编辑成功');
    }

    //添加管理员验证
    public function store(Request $request){
        $this->validate($request,[
            'password'=>'required|min:6|max:18',
            'mobile'=>'required|unique:admins,mobile',
            'name'=>'required'
        ]);
        $admin = Admin::create([
            'password'=>bcrypt($request->get('password')),
            'mobile'=>$request->get('mobile'),
            'name'=>$request->get('name'),

        ]);


        $admin->roles()->sync($request->get('roles'));
        return back()->with('msg','添加成功!');
    }

    //管理员详情
    public function show($id){
        $data = Admin::findOrFail($id);
        return view('admin.admin.show',compact('data'));

    }
    //删除管理员
    public function destroy($id){
        $data = Admin::findOrFail($id);
        if($data->hasRole('admin')){
            return back()->withErrors('msg','不能删除管理员');
        }
        $data->roles()->detach();
        $data->delete();
        return back()->with('msg','删除成功!');
    }*/

}
