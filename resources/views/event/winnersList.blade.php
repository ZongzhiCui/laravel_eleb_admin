@extends('layout.default')
@section('title','获奖表')
@section('content')
    <div class="table-responsive">
    <table class="table table-hover" id="mytable">
        <tr>
            <td>ID</td>
            <td>member_id-获奖人员</td>
            <td>name-奖品</td>
        </tr>
        <marquee direction="up">
        @foreach ($winnersLists as $row)
        <tr data-id="{{ $row->id }}">
            <td>{{ $row->id }}</td>
            <td>{{ $row->business->email }}</td>
            <td>{{ $row->name }}</td>
        </tr>
        @endforeach
        </marquee>
    </table>
        {{ $winnersLists->links() }}
    </div>
@stop
