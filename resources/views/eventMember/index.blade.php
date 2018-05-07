@extends('layout.default')
@section('title','活动表')
@section('content')
    <div class="table-responsive">
    <table class="table table-hover" id="mytable">
        <tr>
            <td>ID</td>
            <td>events_id-活动ID</td>
            <td>member_id-报名商家帐号ID</td>
            <td>操作
                <a href="{{ route('eventMember.create') }}">添加报名</a>
            </td>
        </tr>
        @foreach ($eventMembers as $row)
        <tr data-id="{{ $row->id }}">
            <td>{{$row->id}}</td>
            <td>{{ $row->event->title }}</td>
            <td>{{ $row->user->email }}</td>
            <td>
                {{--没有'权限修改'权限的看不到--}}
                @permission('eventMember.edit')
                <a href="{{ route('eventMember.show',compact('row')) }}" class="btn btn-xs btn-success">查看</a>
                <a href="{{ route('eventMember.edit',['row'=>$row]) }}" class="btn btn-xs btn-primary">编辑</a>
                  <button class="btn btn-xs btn-danger del">删除</button>
                @endpermission
            </td>
        </tr>
        @endforeach
    </table>
        {{ $eventMembers->links() }}
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
                        url: "eventMember/"+id,
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