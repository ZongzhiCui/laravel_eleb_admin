@extends('layout.default')
@section('title','订单统计')
@section('content')
    <table class="table table-bordered">
        <tr>
            <td>店铺ID</td>
            <td>订单量</td>
        </tr>
        @foreach($count as $row)
        <tr>
            <td>{{$row->shop_id}}</td>
            <td>{{$row->m}}</td>
        </tr>
        @endforeach
        <tr>
            <td>总计</td>
            <td>{{$count1}}</td>
        </tr>
    </table>
    @stop