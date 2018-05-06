@extends('layout.default')
@section('content')
    <div class="row" style="text-align: center">
        <div class="col-lg-3"></div>
        <div class="container col-lg-6" style="background-color: #eceeee">
            <br/>
            <a href="{{ route('event.index') }}" class="btn btn-info">活动列表</a>
            <form  method="post" enctype="multipart/form-data" action="{{ route('event.update',compact('event')) }}" style="margin-top: 10px">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="活动标题" name="title" value="{{ $event->title }}">
                </div>
                <div class="form-group">
                    <textarea name="contents" id="container">
                        {{ $event->content }}
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
                    活动开始时间
                    <input type="date" class="form-control" placeholder="开始时间" name="signup_start" value="{{ date('Y-m-d',$event->signup_start) }}">
                </div>
                <div class="form-group">
                    活动结束时间
                    <input type="date" class="form-control" placeholder="结束时间" name="signup_end" value="{{ date('Y-m-d',$event->signup_end) }}">
                </div>
                <div class="form-group">
                    活动开奖时间
                    <input type="date" class="form-control" name="prize_date" value="{{ $event->prize_date }}">
                </div>
                <div class="form-group">
                    活动人数限制:
                    <input type="number" class="form-control" placeholder="分类标题" name="signup_num" value="{{ $event->signup_num }}">
                </div>
                <div class="form-group">
                    是否已开奖('勾选表示已开奖'):
                    <input type="checkbox" class="form-control" name="is_prize" value="1" {{ $event->is_prize==0?'':'checked' }}>
                </div>
                <button type="submit" class="btn btn-primary btn-default"> 修改活动</button>
                {{csrf_field()}}
                {{method_field('PUT')}}
            </form>
        </div>
    </div>
@stop
