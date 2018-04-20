@extends('layout.default')
@section('title','商家')
@section('content')
    <div class="table-responsive">
    <table class="table table-hover" id="mytable">
        <tr>
            <td>ID</td>
            <td>title</td>
            <td>logo</td>
            <td>category</td>
            <td>操作</td>
        </tr>
        <?php foreach ($shop_users as $article):?>
        <tr data-id="{{ $article->id }}">
            <td><?=$article['id']?></td>
            <td><?=$article['title']?></td>
            <td><img src="{{ $article['logo'] }}" width="100px" alt=""></td>
            <td><?=$article->name?></td>
            <td>
{{--                <a href="{{ route('article.show',compact('article')) }}" class="btn btn-xs btn-success">查看</a>--}}
{{--                <a href="{{ route('article.edit',['article'=>$article]) }}" class="btn btn-xs btn-primary">编辑</a>--}}
                  <button class="btn btn-xs btn-danger del">删除</button>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
        {{ $shop_users->links() }}
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
                        url: "shop_user/"+id,
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