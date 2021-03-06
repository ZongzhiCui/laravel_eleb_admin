@extends('layout.default')
@section('title','商铺分类表')
@section('content')
    <div class="table-responsive">
    <table class="table table-hover" id="mytable">
        <tr>
            <td>ID</td>
            <td>name</td>
            <td>display_name</td>
            <td>description</td>
            <td>操作
                <a href="{{ route('permission.create') }}">添加分类</a>
            </td>
        </tr>
        @foreach ($permissions as $row)
        <tr data-id="{{ $row->id }}">
            <td>{{$row->id}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->display_name}}</td>
            <td>{{$row->description}}</td>
            <td>
                {{--没有'权限修改'权限的看不到--}}
                @permission('permission.edit')
                <a href="{{ route('permission.show',compact('row')) }}" class="btn btn-xs btn-success">查看</a>
                <a href="{{ route('permission.edit',['row'=>$row]) }}" class="btn btn-xs btn-primary">编辑</a>
                <button class="btn btn-xs btn-danger del">删除</button>
                @endpermission
            </td>
        </tr>
        @endforeach
    </table>
        {{ $permissions->links() }}
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
                        url: "permission/"+id,
                        data: "_token={{ csrf_token() }}",
                        success: function(msg){
                            if (msg[0] == 0){
                                layer.msg('有角色拥有改权限禁止删除', function(){
                                    //关闭后的操作
                                });
                            }else{
                                layer.msg('删除成功!', function(){
                                    //关闭后的操作
                                });
                                tr.fadeOut(1000);
                            }

                        }
                    });
                }
            });
        })
    </script>
@stop