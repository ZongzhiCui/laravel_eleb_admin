@extends('layout.default')
@section('title','RBAC角色表')
@section('content')
    <div class="table-responsive">
    <table class="table table-hover" id="mytable">
        <tr>
            <td>ID</td>
            <td>name</td>
            <td>display_name</td>
            <td>description</td>
            <td>操作
                <a href="{{ route('role.create') }}">添加角色</a>
            </td>
        </tr>
        @foreach ($roles as $row)
        <tr data-id="{{ $row->id }}">
            <td>{{$row->id}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->display_name}}</td>
            <td>{{$row->description}}</td>
            <td>
                {{--没有'修改'权限的看不到--}}
                @permission('role.edit')
                <a href="{{ route('role.show',compact('row')) }}" class="btn btn-xs btn-success">查看</a>
                <a href="{{ route('role.edit',['row'=>$row]) }}" class="btn btn-xs btn-primary">编辑</a>
                  <button class="btn btn-xs btn-danger del">删除</button>
                @endpermission
            </td>
        </tr>
        @endforeach
    </table>
        {{ $roles->links() }}
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
                        url: "role/"+id,
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