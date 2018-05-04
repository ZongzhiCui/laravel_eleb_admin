@extends('layout.default')
@section('title',$admin->name)
@section('content')
    <a href="{{ route('admin.index') }}" class="btn btn-info">管理员列表</a>
    <h2>管理员ID::{{$admin->id}}</h2>
    <h5>管理员名::{{$admin->name}}</h5>
    <h5>管理员角色::
        @foreach($admin->roles as $val)
            {{$val->display_name}}<br>
        @endforeach
    </h5>
@stop