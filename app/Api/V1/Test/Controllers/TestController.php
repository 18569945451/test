<?php
namespace app\Api\V1\Test\Controllers;

use App\Api\V1\Test\Services\TestServices;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Exceptions\ValidatorException;


class TestController extends Controller
{

    public $service;

    public function __construct()
    {
        $this->service = new TestServices();
    }

    /**
     * @SWG\Swagger( @SWG\Info( title="Test", version="v1" ) )
     */
    /**
     * @SWG\Post(path="/index.php/api/v1/test",
     *   tags={"delicacy/merchant"},
     *   summary="商户注册",
     *   description="商户注册",
     *   operationId="register",
     *   consumes={"multipart/form-data"},
     *   @SWG\Parameter(in="formData",  name="name",type="string",  description="名称", required=true),
     *   @SWG\Parameter(in="formData",  name="password",type="string",  description="密码", required=true),
     *   @SWG\Parameter(in="formData",  name="email",type="string",  description="邮箱", required=true),
     *   @SWG\Parameter(in="formData",  name="photo[0]",type="file",  description="头像", required=true),
     *   @SWG\Parameter(in="formData",  name="photo[1]",type="file",  description="头像", required=true),
     *   @SWG\Parameter(in="header",  name="Authorization",  type="string",  description="Token 前面需要加：'bearer '",required=true),
     *   @SWG\Parameter(in="header",  name="Content-Type",  type="string",  description="application/x-www-form-urlencoded", default="application/x-www-form-urlencoded",required=true),
     *   @SWG\Response(response="403", description="无权限"),
     *   @SWG\Response(response="500", description=""),
     * )
     */
    public function create(Request $request)
    {
        try{
            $data = $this->service->create($request);
            return apiReturn($data);
        }catch (ValidatorException $e){
            return apiReturn([], 403, $e->getMessageBag()->first());
        }

    }

    /**
     * @SWG\Post(path="/index.php/api/v1/login",
     *   tags={"delicacy/merchant"},
     *   summary="login",
     *   description="login",
     *   operationId="login",
     *   consumes={"multipart/form-data"},
     *   @SWG\Parameter(in="formData",  name="name",type="string",  description="名称", required=true),
     *   @SWG\Parameter(in="formData",  name="password",type="string",  description="密码", required=true),
     *   @SWG\Parameter(in="formData",  name="email",type="string",  description="邮箱", required=true),
     *   @SWG\Parameter(in="header",  name="Authorization",  type="string",  description="Token 前面需要加：'bearer '",required=true),
     *   @SWG\Parameter(in="header",  name="Content-Type",  type="string",  description="application/x-www-form-urlencoded", default="application/x-www-form-urlencoded",required=true),
     *   @SWG\Response(response="403", description="无权限"),
     *   @SWG\Response(response="500", description=""),
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        print_r($credentials);exit;
        if (Auth::attempt($credentials)){echo 1212;exit;};
        if (Auth::attempt($credentials)) {
            echo 112;exit;
            // 身份验证通过...
            return redirect()->intended('dashboard');
        }

        // 验证规则，由于业务需求，这里我更改了一下登录的用户名，使用手机号码登录
        $rules = [
            'mobile'   => [
                'required',
                'exists:users',
            ],
            'password' => 'required|string|min:6|max:20',
        ];

        // 验证参数，如果验证失败，则会抛出 ValidationException 的异常
        $params = $this->validate($request, $rules);

        // 使用 Auth 登录用户，如果登录成功，则返回 201 的 code 和 token，如果登录失败则返回
        return ($token = Auth::guard('api')->attempt($params))
            ? response(['token' => 'bearer ' . $token], 201)
            : response(['error' => '账号或密码错误'], 400);
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response(['message' => '退出成功']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

}
