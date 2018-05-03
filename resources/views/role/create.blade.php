@extends('layout.default')
@section('title','添加角色')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Permission</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('role.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                                <label for="display_name" class="col-md-4 control-label">Display_name</label>

                                <div class="col-md-6">
                                    <input id="display_name" type="text" class="form-control" name="display_name" required>

                                    @if ($errors->has('display_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('display_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="description" required>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-md-2 control-label">权限选择</label>
                                <div class="col-md-8">
                                    @foreach($permissions as $row)
                                        <label><input type="checkbox" name="role[]" value="{{$row->id}}" class="form-control-static">{{$row->display_name}}&emsp;</label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        添加角色
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

