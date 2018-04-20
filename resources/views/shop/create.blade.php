@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="container col-lg-4" style="background-color: #eceeee">
            <br/>
            <a href="#" class="btn btn-info">文章列表</a>
            <form  method="post" action="{{ route('article.store') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <label>文章标题</label>
                    <input type="text" class="form-control" placeholder="文章标题" name="title" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label>分类</label>
                    <select class="form-control" name="category_id">
                        @foreach($categorys as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>文章内容</label>
                    <textarea class="form-control" rows="5" name="contents" placeholder="文章内容"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" name="logo" id="exampleInputFile">
                    <p class="help-block">上传合法的图片文件</p>
                </div>
                <div class="form-group">
                    <label>验证码</label>
                    <input id="captcha" name="captcha" class="form-control">
                    <img class="thumbnail captcha" src="{{ captcha_src('inverse') }}" onclick="this.src='/captcha/inverse?'+Math.random()" title="点击图片重新获取验证码">
                </div>
                <button type="submit" class="btn btn-primary btn-success"> 添加文章</button>
                {{csrf_field()}}
            </form>
        </div>
    </div>


@stop
