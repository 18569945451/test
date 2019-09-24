<?php
namespace app\Api\V2\Test\Controllers;

use App\Services\WebServices\TestServices;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public $service;

    public function __construct()
    {
        $this->service = new TestServices();
    }

    /**
     * @SWG\Swagger( @SWG\Info( title="Test", version="v2" ) )
     */
    /**
     * @SWG\Get(path="/index.php/api/v2/test",
     *   tags={"我的测试接口1"},
     *   summary="周期任务列表",
     *   description="周期任务列表",
     *   @SWG\Parameter(in="query",  name="project_id",  type="integer", default="",description="项目ID", required=true),
     *   @SWG\Parameter(in="header",  name="content-type",  type="string",  description="application/x-www-form-urlencoded", default="application/x-www-form-urlencoded",required=true),
     *   @SWG\Parameter(in="header",  name="accept",  type="string", default="application/json",required=true),
     *   @SWG\Parameter(in="header",  name="Authorization",  type="string", default="Bearer ",required=true),
     *   @SWG\Response(response="403", description="无权限"),
     *   @SWG\Response(response="500", description=""),
     * )
     */

    public function index(Request $request)
    {
        echo 'V2';
    }


}
