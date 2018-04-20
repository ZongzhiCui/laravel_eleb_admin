@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="container col-lg-4" style="background-color: #eceeee">
            <br/>
            <a href="#" class="btn btn-info">文章列表</a>
            <form  method="post" action="{{ route('article.update',compact('article')) }}">
                <div class="form-group">
                    <label>文章标题</label>
                    <input type="text" class="form-control" placeholder="文章标题" name="title" value="{{$article->title}}">
                </div>
                <div class="form-group">
                    <label>分类</label>
                    <select class="form-control" name="category_id">
                        @foreach($categorys as $category)
                            <option {{ $article->category_id==$category->id?'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>文章内容</label>
                    <textarea class="form-control" rows="5" name="contents" placeholder="文章内容">{{$article->content}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-success"> 修改文章</button>
                {{csrf_field()}}
                {{ method_field('PUT') }}
            </form>
        </div>
    </div>


@stop
