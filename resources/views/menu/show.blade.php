@extends('layout.default')
@section('title',$menu->name)
@section('content')
    <a href="{{ route('role.index') }}" class="btn btn-info">菜单列表</a>
    <h2>菜单ID::{{$menu->id}}</h2>
    <h5>菜单名称::{{$menu->name}}</h5>
    <h5>菜单父类::{{$menu->pkey}}</h5>
    <h5>菜单父类::{{$menu->url}}</h5>
    <h5>菜单地址::{{$menu->sort}}</h5>
@stop