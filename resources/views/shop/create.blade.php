@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="container col-lg-6" style="background-color: #eceeee">
            <a href="#" class="btn btn-info">商户列表</a>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <form class="form-block" action="{{route('shop.store')}}" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail2">Email</label>
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="exampleInputEmail2" placeholder="邮箱地址">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">password</label>
                                <input type="password" name="password" value="{{old('password')}}" class="form-control" id="exampleInputEmail3" placeholder="密码">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail4">confirm_password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail4" placeholder="确认密码">
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
                                <label for="exampleInputName5">Name</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputName5" placeholder="商铺名称">
                            </div>
                            <div class="form-group">
                                <label for="captcha">captcha</label>
                                <input id="captcha" class="form-control" name="captcha" >
                                <img class="thumbnail captcha" src="{{ captcha_src('inverse') }}" onclick="this.src='/captcha/inverse?'+Math.random()" title="点击图片重新获取验证码">
                            </div>
                            <button type="submit" class="btn btn-success form-control">添加商户</button>
                            {{csrf_field()}}
                        </form>
                    </div>
                    <div class="col-sm-3"></div>
                </div>

        </div>
    </div>

@stop
