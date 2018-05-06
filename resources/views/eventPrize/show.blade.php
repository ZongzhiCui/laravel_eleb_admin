@extends('layout.default')
@section('title',$eventPrize->name)
@section('content')
    <div class="row">
        <div class="col-sm-10">
            <a href="{{ route('eventPrize.index') }}" class="btn btn-info">奖品列表</a>
            <h2>活动ID::{{$eventPrize->event->title}}</h2>
            <h5>奖品名称::{{$eventPrize->name}}</h5>
            <p>奖品内容::
            <textarea name="contents" id="container" readonly>
                {{ $eventPrize->description }}
            </textarea>
            <!-- 配置文件 -->
            <script type="text/javascript" src="/utf8-php/ueditor.config.js"></script>
            <!-- 编辑器源码文件 -->
            <script type="text/javascript" src="/utf8-php/ueditor.all.js"></script>
            <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container');
            </script>
            </p>
            <h5>获奖者::{{ $eventPrize->business->shop_name }}</h5>
        </div>
    </div>
@stop