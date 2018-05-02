@extends('layout.default')
@section('title','菜品统计')
@section('content')
    <div class="panel panel-info">
        <div class="row">
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="3">菜品日统计</th>
                    </tr>
                    <tr>
                        <td>店铺ID</td>
                        <td>菜品id</td>
                        <td>菜品数量</td>
                    </tr>
                    @forelse($day as $key=>$val)
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
                </table>
            </div>
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="3">菜品月统计</th>
                    </tr>
                    <tr>
                        <td>店铺ID</td>
                        <td>菜品id</td>
                        <td>菜品数量</td>
                    </tr>
                    @forelse($month as $key=>$val)
                    <tr>
                        <td rowspan="{{count($val)+1}}">{{$shop_ids[$key]->shop_name}}</td>
                    </tr>
                        @foreach($val as $row)
                            <tr>
                            <td>{{$row->foods_id}}</td>
                            <td>{{$row->m}}</td>
                            </tr>
                        @endforeach
                        @empty
                    @endforelse
                </table>
            </div>
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="3">菜品总统计</th>
                    </tr>
                    <tr>
                        <td>店铺ID</td>
                        <td>菜品id</td>
                        <td>菜品数量</td>
                    </tr>
                    @forelse($total as $key=>$val)
                    <tr>
                        <td rowspan="{{count($val)+1}}">{{$shop_ids[$key]->shop_name}}</td>
                    </tr>
                        @foreach($val as $row)
                            <tr>
                            <td>{{$row->foods_id}}</td>
                            <td>{{$row->total}}</td>
                            </tr>
                        @endforeach
                        @empty
                    @endforelse
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <tr>
                        <form action="{{route('food.time')}}" method="post" class="form-control">
                            <th>
                                范围查询:<input type="date" name="datetime1">--
                                <input type="date" name="datetime2">
                                <button class="btn btn-group-sm btn-info">查询</button>
                            </th>
                            {{ csrf_field() }}
                        </form>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @stop