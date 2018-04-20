@extends('layout.default')
@section('title','商家')
@section('content')
    <div class="table-responsive">
    <table class="table table-hover" id="mytable">
        <tr>
            <td>ID</td>
            <td>email</td>
            <td>status</td>
            <td>business_id</td>
            <td>商铺名称</td>
            <td>操作
                <a href="{{ route('shop.create') }}">添加商户</a>
            </td>
        </tr>
        @foreach ($shopUsers as $shopUser)
        <tr data-id="{{ $shopUser->id }}">
            <td>{{$shopUser->id}}</td>
            <td>{{$shopUser->email}}</td>
            <td>{{$shopUser->status}}</td>
            <td>{{$shopUser->business_id}}</td>
            <td>{{$shopUser->shop_business->shop_name}}</td>
            <td>
                <a href="{{ route('shop.edit',compact('shopUser')) }}" class="btn btn-xs btn-success">查看</a>
{{--                <a href="{{ route('shop.edit',['shopUser'=>$shopUser]) }}" class="btn btn-xs btn-primary">编辑</a>--}}
                  <button class="btn btn-xs btn-danger del">删除</button>
            </td>
        </tr>
        @endforeach
    </table>
        {{ $shopUsers->links() }}
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
                        url: "shopUser/"+id,
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