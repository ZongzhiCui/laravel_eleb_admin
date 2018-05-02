@extends('layout.default')
@section('title','订单统计')
@section('content')
    <div class="panel panel-info">
        <div class="row">
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <captain>订单日统计</captain>
                    <tr>
                        <td>店铺ID</td>
                        <td>店铺订单数</td>
                    </tr>
                    @foreach($day as $row)
                    <tr>
                        <td>{{$row->shop_id}}</td>
                        <td>{{$row->m}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>总计</td>
                        <td>{{$count3}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <captain>订单月统计</captain>
                    <tr>
                        <td>店铺ID</td>
                        <td>店铺订单数</td>
                    </tr>
                    @foreach($month as $row)
                        <tr>
                            <td>{{$row->shop_id}}</td>
                            <td>{{$row->m}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>总计</td>
                        <td>{{$count2}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <captain>订单总统计</captain>
                    <tr>
                        <td>店铺ID</td>
                        <td>店铺订单数</td>
                    </tr>
                    @foreach($total as $row)
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
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
            <table class="table table-bordered">
                <tr>
                    <form action="{{route('order.time')}}" method="post" class="form-control">
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

@section('jquery')
    <script type="text/javascript">
        $(function () {

        })
    </script>
    @stop