@extends('layout.default')
@section('title','添加活动')
@section('content')
    <div class="row" style="text-align: center">
        <div class="col-lg-3"></div>
        <div class="container col-lg-6" style="background-color: #eceeee">
            <br/>
            <a href="{{ route('activity.index') }}" class="btn btn-info">活动列表</a>
            <form  method="post" enctype="multipart/form-data" action="{{ route('activity.store') }}" style="margin-top: 10px">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="活动标题" name="title" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <textarea name="contents" id="container">
                        {{ old('content') }}
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
                    <input type="date" class="form-control" placeholder="分类标题" name="start_time" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" placeholder="分类标题" name="end_time" value="{{ old('title') }}">
                </div>
                <button type="submit" class="btn btn-primary btn-default"> 添加活动</button>
                {{csrf_field()}}
            </form>
        </div>
    </div>
@stop
