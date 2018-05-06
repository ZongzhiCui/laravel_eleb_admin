@extends('layout.default')
@section('title','添加奖品')
@section('content')
    <div class="row" style="text-align: center">
        <div class="col-lg-3"></div>
        <div class="container col-lg-6" style="background-color: #eceeee">
            <br/>
            <a href="{{ route('eventPrize.index') }}" class="btn btn-info">奖品列表</a>
            <form  method="post" enctype="multipart/form-data" action="{{ route('eventPrize.store') }}" style="margin-top: 10px">
                <div class="form-group">
                    活动id
                    <select name="events_id" class="form-control">
                        @foreach($events as $row)
                            <option value="{{ $row->id }}">{{ $row->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="奖品名称" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="奖品数量" name="num" value="{{ old('num') }}">
                </div>
                <div class="form-group">
                    <textarea name="description" id="container">
                        {{ old('description') }}
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
                <button type="submit" class="btn btn-primary btn-default"> 添加奖品</button>
                {{csrf_field()}}
            </form>
        </div>
    </div>
@stop
