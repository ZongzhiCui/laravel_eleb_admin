@extends('layout.default')
@section('title',$role->name)
@section('content')
    <a href="{{ route('role.index') }}" class="btn btn-info">角色列表</a>
    <h2>权限ID::{{$role->id}}</h2>
    <h5>权限名称::{{$role->name}}</h5>
    <h5>权限显示名称::{{$role->display_name}}</h5>
    <h5>权限描述::{{$role->description}}</h5>
@stop