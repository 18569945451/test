<?php
namespace app\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Swagger\Annotations\Swagger;

class ApiDocController extends Controller
{
    public function getJson($version = 'V1', $client = 'Test')
    {
        $version = Str::studly($version);
        $client  = Str::studly($client);

        $swagger = \Swagger\scan(app_path("Api/{$version}/{$client}/Controllers/"));
        return response()->json($swagger, 200);
    }

}