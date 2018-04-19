@extends('layout.default')
@section('title','添加文章分类')
@section('content')
    <div class="row" style="text-align: center">
        <div class="col-lg-4"></div>
        <div class="container col-lg-4" style="background-color: #eceeee">
            <br/>
            <a href="{{ route('category.index') }}" class="btn btn-info">分类列表</a>
            <form  method="post" enctype="multipart/form-data" action="{{ route('category.store') }}" style="margin-top: 10px">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="分类标题" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <input type="file" class="form-control" placeholder="分类图片" name="logo" value="{{ old('logo') }}">
                </div>
                <button type="submit" class="btn btn-primary btn-default"> 添加文章分类</button>
                {{csrf_field()}}
            </form>
        </div>
    </div>
@stop

