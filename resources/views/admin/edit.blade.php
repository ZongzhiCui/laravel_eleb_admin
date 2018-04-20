@extends('layout.default')
@section('title','修改密码')
@section('content')
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <form class="form-block" action="{{route('admin.update',compact('admin'))}}" method="post">
                <div class="form-group">
                    <p>用户名: </p>
                </div>
                <div class="form-group">
                    <label for="exampleInputName5">Name</label>
                    <input type="text" readonly name="name" value="{{ $admin->name }}" class="form-control" id="exampleInputName5" placeholder="商铺名称">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">oldpassword</label>
                    <input type="password" name="oldpassword" class="form-control" id="exampleInputEmail2" placeholder="密码">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">newpassword</label>
                    <input type="password" name="password" class="form-control" id="exampleInputEmail3" placeholder="密码">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail4">confirm_password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail4" placeholder="确认密码">
                </div>
                <button type="submit" class="btn btn-success form-control">提交!</button>
                {{csrf_field()}}
                {{ method_field('PUT') }}
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
    @stop