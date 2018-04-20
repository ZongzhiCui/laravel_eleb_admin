@extends('layout.default')
@section('content')
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 bg-info">
            <a class="btn btn-group" href="{{ route('shop_business.show',compact('shop_business')) }}">查看信息</a>
            <p>商铺名称::{{$shop_business->shop_name}}</p>
            <form action="{{ route('shop_business.update',compact('shop_business')) }}" method="post" enctype="multipart/form-data">
                <br>
                店铺LOGO:<input class="form-control" type="file" name="shop_img" placeholder="店铺LOGO"><br>

                店铺评分:<input class="form-control" type="text" name="shop_rating" value="{{$shop_business->shop_rating}}" placeholder="店铺评分"><br>

                <label>是否品牌:<input {{$shop_business->brand==0?'':'checked'}} class="form-control" type="checkbox" name="brand" value="1"></label>
                <label>是否准时:<input {{$shop_business->on_time==0?'':'checked'}} class="form-control" type="checkbox" name="on_time" value="1"></label>
                <label>是否蜂鸟:<input {{$shop_business->fengniao==0?'':'checked'}} class="form-control" type="checkbox" name="fengniao" value="1"></label>
                <label>是否保标:<input {{$shop_business->bao==0?'':'checked'}} class="form-control" type="checkbox" name="bao" value="1"></label>
                <label>是否票标:<input {{$shop_business->piao==0?'':'checked'}} class="form-control" type="checkbox" name="piao" value="1"></label>
                <label>是否准标:<input {{$shop_business->zhun==0?'':'checked'}} class="form-control" type="checkbox" name="zhun" value="1"></label><br>

                起送金额:<input class="form-control" type="number" name="start_send" value="{{$shop_business->start_send}}" placeholder="起送金额"><br>
                配送费用:<input class="form-control" type="number" name="send_cost" value="{{$shop_business->send_cost}}" placeholder="配送费用"><br>
                预计时间:<input class="form-control" type="number" name="estimate_time" value="{{$shop_business->estimate_time}}" placeholder="预计时间"><br>
                小店公告:<textarea class="form-control" name="notice">{{$shop_business->notice}}</textarea><br>
                优惠信息:<textarea class="form-control" name="discount">{{$shop_business->discount}}</textarea><br>
                <input class="form-control" type="submit"><br>
                {{ csrf_field() }}
                {{ method_field('PUT') }}
            </form>
        </div>
        <div class="col-sm-3" style="position: relative"><img style="position: absolute;right: 17px;top: 0;" src="{{$shop_business->shop_img}}" alt=""></div>
    </div>
@stop
