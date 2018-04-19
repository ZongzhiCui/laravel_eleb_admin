@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="container col-lg-4" style="background-color: #eceeee">
            <br>
            <a href="{{ route('category.index') }}" class="btn btn-info btn-block">分类列表</a>
            <br>
            <form  method="post" action="{{ route('category.update',compact('category')) }}">
                <div class="form-group">
                    <label>文章分类</label>
                    <input type="text" class="form-control" placeholder="文章分类名称" name="name" value="{{$category->name}}">
                </div>
                <div class="form-group">
                    <input type="file" class="form-control" placeholder="分类图片" name="logo" value="{{$category->logo}}">
                </div>
                <img src="{{$category->logo}}" alt="">
                <button type="submit" class="btn btn-primary btn-success"> 修改文章分类</button>
                {{csrf_field()}}
                {{ method_field('PUT') }}
            </form>
        </div>
    </div>


@stop
