@extends('layout.default')
@section('title',$permission->name)
@section('content')
    <a href="{{ route('permission.index') }}" class="btn btn-info">权限列表</a>
    <h2>权限ID::{{$permission->id}}</h2>
    <h5>权限名称::{{$permission->name}}</h5>
    <h5>权限显示名称::{{$permission->display_name}}</h5>
    <h5>权限描述::{{$permission->description}}</h5>
@stop