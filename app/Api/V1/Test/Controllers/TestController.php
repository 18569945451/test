<?php
namespace app\Api\V1\Test\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * @SWG\Swagger( @SWG\Info( title="Test", version="v1" ) )
     */
    /**
     * @SWG\Get(path="/v1/user",
     *   tags={"我的测试接口"},
     *   summary="周期任务列表",
     *   description="周期任务列表",
     *   @SWG\Parameter(in="query",  name="project_id",  type="integer", default="",description="项目ID", required=true),
     *   @SWG\Response(response="403", description="无权限"),
     *   @SWG\Response(response="500", description=""),
     * )
     */
    public function index(Request $request)
    {
        echo 12121;exit;
    }
}
