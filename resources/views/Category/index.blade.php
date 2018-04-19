@extends('layout.default')
@section('title','商铺分类表')
@section('content')
    <div class="table-responsive">
    <table class="table table-hover" id="mytable">
        <tr>
            <td>ID</td>
            <td>name</td>
            <td>logo</td>
            <td>操作
                <a href="{{ route('category.create') }}">添加分类</a>
            </td>
        </tr>
        @foreach ($categorys as $category)
        <tr data-id="{{ $category->id }}">
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td><img src="{{$category->logo}}" alt=""></td>
            <td>
                <a href="{{ route('category.show',compact('category')) }}" class="btn btn-xs btn-success">查看</a>
                <a href="{{ route('category.edit',['category'=>$category]) }}" class="btn btn-xs btn-primary">编辑</a>
                  <button class="btn btn-xs btn-danger del">删除</button>
            </td>
        </tr>
        @endforeach;
    </table>
        {{ $categorys->links() }}
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
                        url: "category/"+id,
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