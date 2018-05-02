<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $width = $request->width??150;
        $height = $request->height??150;
        $filename = $request->file('file')->store('public/date'.date('md'));
        //制作缩略图
        $thumb = $this->thumb($filename,$width,$height);
        //上传到阿里OSS
        $ToAliOss = $this->toAliOss($thumb,'eleb/shop/');
//        return ['url'=>url(Storage::url($filename))];
        return ['url'=>$ToAliOss];
    }
    //富文本上传
    public function upload1(Request $request)
    {
        //上传到阿里OSS
        $ToAliOss = $this->toAliOss($request->filename,'eleb/shop/');
//        return ['url'=>url(Storage::url($filename))];
        return ['url'=>$ToAliOss];
    }
}
