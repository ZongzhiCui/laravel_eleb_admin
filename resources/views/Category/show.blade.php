@extends('layout.default')
@section('title',$category->name)
@section('content')
    <a href="{{ route('category.index') }}" class="btn btn-info">分类列表</a>
    <h2>分类ID::{{$category->id}}</h2>
    <h5>分类名称::{{$category->name}}</h5>
    <h5>分类logo::</h5>
    <img src="{{$category->logo}}" alt="">
@stop