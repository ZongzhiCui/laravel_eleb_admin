@extends('layout.default')
@section('title','修改角色')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Permission</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.updatePermission',compact('admin')) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $admin->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-md-2 control-label">角色选择</label>
                                <div class="col-md-8">
                                    @foreach($roles as $row)
                                        <label><input type="checkbox" name="role[]" value="{{$row->id}}" {{$admin->hasRole($row->name)?'checked':''}} class="form-control-static">{{$row->display_name}}&emsp;</label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        修改角色
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
