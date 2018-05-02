<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //上传图片,制作缩略图
    public function thumb($filename,$width=100,$height=100)
    {
        $path_parts = pathinfo(Storage::url($filename)); //Storage::url($filename);这个才是可用的图片路径
        $i_mg = $path_parts['filename'].'_'.$width.'X'.$height.'.'.$path_parts['extension']; //拼接缩略图文件路径
        $img = Image::make(public_path().Storage::url($filename))->resize($width, $height);//图片资源必须绝对路径!缩略图
        $img->save(public_path().$path_parts['dirname'].'/'.$i_mg);
        return dirname($filename).'/'.$i_mg;
    }
    //上传到阿里OSS
    public function toAliOss($filename,$ossPath='eleb/shop/')
    {
        $client = App::make('aliyun-oss');
        //    $client->putObject(getenv('OSS_BUCKET'), "eleb/shop/1.txt", "上传文件3个参数:BUCKET名,文件名,文件内容");
//    $result = $client->getObject(getenv('OSS_BUCKET'), "eleb/shop/1.txt");
//    echo $result;
        //将D:\www\eleb\eleb_shop\storage\app\public\date0422\SuncCvPZ1aSE7FjfUB2Zz7LrI39MGgrKnhhmzMSQ.jpeg
        //上传到阿里云OSS服务器
        try{
            $client->uploadFile(getenv('OSS_BUCKET'),
                $ossPath.$filename,
                storage_path('app/'.$filename));
            return 'https://tina-laravel.oss-cn-beijing.aliyuncs.com/'.$ossPath.urlencode($filename);
        } catch(\OSS\Core\OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            echo '上传失败';
            return;
        }
    }
}
