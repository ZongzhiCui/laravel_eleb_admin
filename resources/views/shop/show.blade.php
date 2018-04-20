@extends('layout.default')
@section('title',$article->title)
@section('content')
    <h2>文章标题::{{$article->title}}</h2>
    <h5>浏览量::{{$article->views}}</h5>
    <h4>文章内容::{{$article->content}}</h4>
@stop