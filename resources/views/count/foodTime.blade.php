@extends('layout.default')
@section('title','菜品统计')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th colspan="3">菜品统计</th>
        </tr>
        <tr>
            <td>店铺ID</td>
            <td>菜品id</td>
            <td>菜品数量</td>
        </tr>
        @forelse($count as $key=>$val)
            <tr>
                <td rowspan="{{count($val)+1}}">{{$shop_ids[$key]->shop_name}}</td>
            </tr>
            @foreach($val as $row)
                <tr>
                    <td>{{$row->foods_id}}</td>
                    <td>{{$row->d}}</td>
                </tr>
            @endforeach
        @empty
        @endforelse
        <tr>
            <td></td>
            <td>总计:</td>
            <td>{{$count1}}</td>
        </tr>
    </table>
@stop