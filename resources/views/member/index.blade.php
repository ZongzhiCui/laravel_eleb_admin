@extends('layout.default')
@section('title','会员列表')
@section('content')
    <div class="panel panel-info">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered">
                <tr>
                    <th>会员ID</th>
                    <th>会员名</th>
                    <th>会员电话</th>
                    <th>会员状态</th>
                    <th>会员操作</th>
                </tr>
                @foreach($members as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->username}}</td>
                    <td>{{$row->tel}}</td>
                    <td>{{$row->status==-1?'封号':'可用'}}</td>
                    <td>
                        <a href="{{route('member.show',compact('row'))}}">查看</a>
                    </td>
                </tr>
                @endforeach
            </table>
            {{$members->links()}}
        </div>
    </div>
    </div>
@stop