@extends('layout.default')
@section('title','菜单列表')
@section('content')
    <div class="table-responsive">
    <table class="table table-hover" id="mytable">
        <tr>
            <td>ID</td>
            <td>name-名称</td>
            <td>pkey-父类</td>
            <td>URL-地址/路由</td>
            <td>sort-排序</td>
            <td>操作
                <a href="{{ route('menu.create') }}">添加菜单</a>
            </td>
        </tr>
        @foreach ($menus as $row)
        <tr data-id="{{ $row->id }}">
            <td>{{$row->id}}</td>
            {{--<td>{{$row->name_txt}}</td>--}}
            <td>{{$row->name}}</td>
            <td>{{$row->pkey}}</td>
            <td>{{$row->url}}</td>
            <td>{{$row->sort}}</td>
            <td>
                <a href="{{ route('menu.show',compact('row')) }}" class="btn btn-xs btn-success">查看</a>
                <a href="{{ route('menu.edit',['row'=>$row]) }}" class="btn btn-xs btn-primary">编辑</a>
                  <button class="btn btn-xs btn-danger del">删除</button>
            </td>
        </tr>
        @endforeach
    </table>
        {{ $menus->links() }}
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
                        url: "menu/"+id,
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