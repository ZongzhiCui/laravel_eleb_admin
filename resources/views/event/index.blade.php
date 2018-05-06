@extends('layout.default')
@section('title','活动表')
@section('content')
    <div class="table-responsive">
    <table class="table table-hover" id="mytable">
        <tr>
            <td>ID</td>
            <td>title-标题</td>
            <td>signup_start-报名开始时间</td>
            <td>signup_end-报名结束时间</td>
            <td>prize_date-开奖日期</td>
            <td>signup_num-报名人数限制</td>
            <td>is_prize-是否已开奖</td>
            <td>操作
                <a href="{{ route('event.create') }}">添加活动</a>
            </td>
        </tr>
        @foreach ($activitys as $row)
        <tr data-id="{{ $row->id }}">
            <td>{{$row->id}}</td>
            <td><sup style="color: red">{{ date('Y-m-d',$row->signup_end)<date('Y-m-d')?'该活动已过期!':''}}</sup>{{$row->title}}</td>
            <td>{{ date('Y-m-d H:i:s',$row->signup_start) }}</td>
            <td>{{ date('Y-m-d H:i:s',$row->signup_end) }}</td>
            <td>{{ $row->prize_date }}</td>
            <td>{{ $row->signup_num }}</td>
            <td>{{ $row->is_prize==0?'未开奖':'已开奖' }}</td>
            <td>
                {{--没有'权限修改'权限的看不到--}}
                @permission('event.edit')
                <a href="{{ route('event.show',compact('row')) }}" class="btn btn-xs btn-success">查看</a>
                <a href="{{ route('event.edit',['row'=>$row]) }}" class="btn btn-xs btn-primary">编辑</a>
                  <button class="btn btn-xs btn-danger del">删除</button>
                @endpermission
            </td>
        </tr>
        @endforeach
    </table>
        {{ $activitys->links() }}
    </div>
@stop

@section('jquery')
    <script type="text/javascript">
        $(function () {
            $('#mytable .del').click(function () {
                if (confirm('确认删除改数据吗!?')){
                    var tr = $(this).closest('tr');
                    var id = tr.data('id');
                    $.ajax({
                        type:'DELETE',
                        url: "event/"+id,
                        data: "_token={{ csrf_token() }}",
                        success: function(msg){
//                            console.log(msg.success);
                            if (msg.success === false){
                                layer.msg(msg.danger, function(){
                                    //关闭后的操作
                                });
                                return;
                            }
                            tr.fadeOut(1000);
                        }
                    });
                }
            });
        })
    </script>
@stop