@extends('layout.default')
@section('title','管理员表')
@section('content')
    <div class="table-responsive">
    <table class="table table-hover" id="mytable">
        <tr>
            <td>ID</td>
            <td>name</td>
            <td>操作
                <a href="{{ route('admin.create') }}">添加管理员</a>
            </td>
        </tr>
        @foreach ($admins as $row)
        <tr data-id="{{ $row->id }}">
            <td>{{$row->id}}</td>
            <td>{{$row->name}}</td>
            <td>
                <a href="{{ route('admin.show',compact('row')) }}" class="btn btn-xs btn-success">查看</a>
                <a href="{{ route('admin.editPermission',['row'=>$row]) }}" class="btn btn-xs btn-primary">编辑</a>
                  <button class="btn btn-xs btn-danger del">删除</button>
            </td>
        </tr>
        @endforeach
    </table>
        {{ $admins->links() }}
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
                        url: "admin/"+id,
                        data: "_token={{ csrf_token() }}",
                        success: function(msg){
                            tr.fadeOut(1000);
                        }
                    });
                }
            });
        })
    </script>
@stop