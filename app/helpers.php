<?php
if (!function_exists('generateFilePath')) {

    /**
     * 生成统一文件存储路径
     * @return string
     */
    function generateFilePath()
    {
        return 'public/'.date('Ym').'/'.date('d').'/';
    }
}
if (!function_exists('saveImageResource')) {
    /**
     * 保存资源图片
     * @param $image
     *
     * @return string
     */
    function saveImageResource(\Illuminate\Http\UploadedFile $image)
    {
        //获取宽高
        list($width, $height) = getimagesize($image);

        //获取hash
        $hash = $image->hashName();

        //修改后的全名
        $joinString          = '-'.$width.'x'.$height;
        $position            = strpos($hash, '.');
        $fileNameWithWidthHeight = substr_replace($hash, $joinString, $position, 0);

        $path = $image->storeAs(substr(generateFilePath(), 0, -1),$fileNameWithWidthHeight);
        return generateFileUrl($path);
    }
}
if (!function_exists('apiReturn')) {

    /**
     * api 接口返回格式规范
     * @param string $status
     * @param array $data
     * @param int $code
     * @param string $msg
     * @return \Illuminate\Http\JsonResponse
     */
    function apiReturn($data = [],$code = 0 ,$msg = '',$status = '')
    {
        $code   = empty($code)      ? 200       : $code;
        $status = empty($status)    ? 'success' : $status;
        $message= empty($msg)       ? 'success' : $msg;

        switch ($code) {
            case 301 :
            case 400 :
            case 403 :
            case 404 :
            case 405 :
            case 500 :
                $status = 'error';
                break;
        }
        //默认200
        if ($code == 200){
            return response()->json(compact('status','data','code','message'));
        }
        return response()->json(compact('status','code','message'));
    }

}
if (!function_exists('generateFileUrl')) {

    /**
     * 生成文件url
     * @param string $filePath storage相对路径
     * @return string   完整url（需要配置APP_URL，切记，所有想被公开访问的文件都应该放在 storage/app/public 目录下。此外，你应该在public/storage [创建符号链接 ] (#the-public-disk) 来指向 storage/app/public 文件夹。）
     */
    function generateFileUrl($filePath)
    {
        return env('APP_URL').Storage::url($filePath);
    }
}
if (!function_exists('dbPoint')) {

    /**
     * 生成空间位置坐标
     * @param float $long 经度
     * @param float $lat  纬度
     *
     * @return mixed
     */
    function dbPoint(float $long,float $lat)
    {
        return \DB::raw("GeomFromText('POINT({$long} {$lat})')");
    }
}
if (!function_exists('analyticPoint')) {

    /**
     * 解析
     * @param $value
     * @return mixed
     */
    function analyticPoint($value)
    {
        if (!$value){
            return null;
        }

        if (is_object($value)){
            $pointValue = $value->getValue();
            $array = explode(' ', $pointValue);
            $long  = explode('(', $array[0])[2];
            $lat   = explode(')', $array[1])[0];
        }else{
            $array = explode(' ', $value);
            $long  = explode('(', $array[0])[1];
            $lat   = explode(')', $array[1])[0];
        }

        return compact('long','lat');
    }
}