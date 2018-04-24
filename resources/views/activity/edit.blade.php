@extends('layout.default')
@section('content')
    <div class="row" style="text-align: center">
        <div class="col-lg-3"></div>
        <div class="container col-lg-6" style="background-color: #eceeee">
            <br/>
            <a href="{{ route('activity.index') }}" class="btn btn-info">活动列表</a>
            <form  method="post" enctype="multipart/form-data" action="{{ route('activity.update',compact('activity')) }}" style="margin-top: 10px">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="活动标题" name="title" value="{{ $activity->title }}">
                </div>
                <div class="form-group">
                    <textarea name="contents" id="container">
                        {{ $activity->content }}
                    </textarea>
                    <!-- 配置文件 -->
                    <script type="text/javascript" src="/utf8-php/ueditor.config.js"></script>
                    <!-- 编辑器源码文件 -->
                    <script type="text/javascript" src="/utf8-php/ueditor.all.js"></script>
                    <!-- 实例化编辑器 -->
                    <script type="text/javascript">
                        var ue = UE.getEditor('container');
                    </script>
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" placeholder="开始时间" name="start_time" value="{{ substr($activity->start_time,0,10) }}">
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" placeholder="结束时间" name="end_time" value="{{ substr($activity->end_time,0,10) }}">
                </div>
                <button type="submit" class="btn btn-primary btn-default"> 修改活动</button>
                {{csrf_field()}}
                {{method_field('PUT')}}
            </form>
        </div>
    </div>
@stop
