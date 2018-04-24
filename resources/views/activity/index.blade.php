@extends('layout.default')
@section('title','活动表')
@section('content')
    <div class="table-responsive">
    <table class="table table-hover" id="mytable">
        <tr>
            <td>ID</td>
            <td>title</td>
            <td>content</td>
            <td>start_time</td>
            <td>end_time</td>
            <td>操作
                <a href="{{ route('activity.create') }}">添加分类</a>
            </td>
        </tr>
        @foreach ($activitys as $row)
        <tr data-id="{{ $row->id }}">
            <td>{{$row->id}}</td>
            <td><sup style="color: red">{{$row->end_time<date('Y-m-d')?'该活动已过期!':''}}</sup>{{$row->title}}</td>
            <td>{!! $row->content !!}</td>
            <td>{{$row->start_time}}</td>
            <td>{{$row->end_time}}</td>
            <td>
                <a href="{{ route('activity.show',compact('row')) }}" class="btn btn-xs btn-success">查看</a>
                <a href="{{ route('activity.edit',['row'=>$row]) }}" class="btn btn-xs btn-primary">编辑</a>
                  <button class="btn btn-xs btn-danger del">删除</button>
            </td>
        </tr>
        @endforeach;
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
                        url: "activity/"+id,
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