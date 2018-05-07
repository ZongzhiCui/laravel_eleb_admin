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
            <h5 data-time="{{ $event->prize_date }}">开奖时间::{{ $event->prize_date }}------
                <button id="myButton" disabled class="btn btn-sm btn-primary" data-id="{{ $event->id }}">我要开奖了!</button>
            </h5>
            <h5>活动限制人数::{{ $event->signup_num }}</h5>
        </div>
    </div>
@stop

@section('jquery')
    <script type="text/javascript">
        $(function () {
            var myDate = $('#myButton').closest('h5').data('time');
            myDate = myDate.replace(/-/g,'/'); //将-替换成/，因为下面这个构造函数只支持/分隔的日期字符串
            myDate = new Date(myDate);  //构造一个日期型数据，值为传入的字符串

            //开奖日期当天
            var day = new Date(myDate);
            //开奖日期第二天
            var tomorrow = myDate.setDate(myDate.getDate()+1);
            tomorrow = new Date(tomorrow);
            //今天
            var today = new Date();
//            console.log(day,'111',today,'111',tomorrow);
            if (day <= today && today <= tomorrow){
                $('#myButton').prop('disabled',false);
                $('#myButton').on('click',function () {
                    //获取活动ID
                    var id = $('#myButton').data('id');
                    $.ajax({
                        type: "GET",
                        url: "/lottery/"+id,
//                        data: "name=John&location=Boston",
                        success: function(msg){
                            if (msg.success === true){
                                layer.msg(msg.danger, function(){
                                    //关闭后的操作
                                });
                                return;
                            }
                        }
                    });
                })
            }
        })
    </script>
@stop