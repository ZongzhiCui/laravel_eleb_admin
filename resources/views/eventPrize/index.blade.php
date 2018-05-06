@extends('layout.default')
@section('title','活动表')
@section('content')
    <div class="table-responsive">
    <table class="table table-hover" id="mytable">
        <tr>
            <td>ID</td>
            <td>events_id-活动ID</td>
            <td>name-奖品名称</td>
            <td>description-奖品详情</td>
            <td>member_id-中奖商家帐号ID</td>
            <td>操作
                <a href="{{ route('eventPrize.create') }}">添加奖品</a>
            </td>
        </tr>
        @foreach ($eventPrizes as $row)
        <tr data-id="{{ $row->id }}">
            <td>{{$row->id}}</td>
            <td>{{ $row->event->title }}</td>
            <td>{{$row->name}}</td>
            <td>{!! $row->description !!}</td>
            <td>{{ $row->business->shop_name }}</td>
            <td>
                <a href="{{ route('eventPrize.show',compact('row')) }}" class="btn btn-xs btn-success">查看</a>
                <a href="{{ route('eventPrize.edit',['row'=>$row]) }}" class="btn btn-xs btn-primary">编辑</a>
                  <button class="btn btn-xs btn-danger del">删除</button>
            </td>
        </tr>
        @endforeach
    </table>
        {{ $eventPrizes->links() }}
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
                        url: "eventPrize/"+id,
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