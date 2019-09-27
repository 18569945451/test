<?php
namespace app\Api\V1\Test\Controllers;

use App\Api\V1\Test\Entities\Test;
use App\Api\V1\Test\Services\TestServices;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

}
