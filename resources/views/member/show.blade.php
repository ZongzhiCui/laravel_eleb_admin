@extends('layout.default')
@section('title','会员列表')
@section('content')
    <div class="panel panel-info"><br>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-8">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge">1</span>
                        会员ID::{{$member->id}}
                    </li>
                    <li class="list-group-item">
                        <span class="badge">2</span>
                        会员名::{{$member->username}}
                    </li>
                    <li class="list-group-item">
                        <span class="badge">3</span>
                        会员邮箱::{{$member->email}}
                    </li>
                    <li class="list-group-item">
                        <span class="badge">4</span>
                        会员电话::{{$member->tel}}
                    </li>
                    <li class="list-group-item">
                        <span class="badge">5</span>
                        会员状态::{{$member->status==-1?'封号':'可用'}}
                    </li>
                    <li class="list-group-item">
                        <span class="badge">99</span>
                        <form action="{{route('member.update',compact('member'))}}" method="post">
                        封号/解封::<button class="btn btn-sm btn-danger">处理</button>
                            {{csrf_field()}}
                            {{ method_field('PUT') }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@stop
@section('jquery')
    <script type="text/javascript">
        $(function () {
            /**$.ajax({
                type: "POST",
                url: "some.php",
                data: "name=John&location=Boston",
                success: function(msg){
                    alert( "Data Saved: " + msg );
                    layer.msg('玩命卖萌中', function(){
                    //关闭后的操作
                    });
                }
            });*/
        })
    </script>
    @stop