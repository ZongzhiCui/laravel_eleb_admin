@extends('layout.default')
@section('title',$event->name)
@section('content')
    <div class="row">
        <div class="col-sm-10">
            <a href="{{ route('event.index') }}" class="btn btn-info">活动列表</a>
            <h2>活动ID::{{$event->id}}</h2>
            <h5>活动标题::{{$event->title}}</h5>
            <p>活动内容::
            <textarea name="contents" id="container" readonly>
                {{$event->content}}
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
            <h5>开始时间::{{ date('Y-m-d H:i:s',$event->signup_start) }}</h5>
            <h5>结束时间::{{ date('Y-m-d H:i:s',$event->signup_end) }}</h5>
            <h5>开奖时间::{{ $event->prize_date }}</h5>
            <h5>活动限制人数::{{ $event->signup_num }}</h5>
        </div>
    </div>
@stop