@extends('layout.default')
@section('title','修改菜单')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Menu-菜单</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('menu.update',compact('menu')) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name-名称</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $menu->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('pkey') ? ' has-error' : '' }}">
                                <label for="pkey" class="col-md-4 control-label">pkey-上级菜单</label>

                                <div class="col-md-6">
                                    <select name="pkey" class="form-control">
                                        <option value="0">顶级分类</option>
                                        @foreach($menus as $row)
                                            <option value="{{ $row->id }}" {{ $row->id==$menu->pkey?'selected':'' }}>{{ $row->name_txt }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('pkey'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('pkey') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                                <label for="url" class="col-md-4 control-label">URL-地址/路由</label>

                                <div class="col-md-6">
                                    <input id="url" type="text" class="form-control" name="url" value="{{ $menu->url }}" required>

                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
                                <label for="sort" class="col-md-4 control-label">Sort-排序</label>

                                <div class="col-md-6">
                                    <input id="sort" type="text" class="form-control" name="sort" value="{{ $menu->sort }}" required>

                                    @if ($errors->has('sort'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sort') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        修改菜单
                                    </button>

                                    {{--<a class="btn btn-link" href="#">--}}
                                        {{--Forgot Your Password?--}}
                                    {{--</a>--}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

