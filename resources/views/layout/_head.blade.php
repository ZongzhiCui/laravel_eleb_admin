<!--导航条-->
<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Zongzhi-Cui</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            {{--<ul class="nav navbar-nav">
                <li class="active"><a href="/">商铺分类<span class="sr-only">(current)</span></a></li>
                <li class="active"><a href=" {{ route('shop.index') }}">商家信息</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">其他 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('activity.index')}}">活动列表</a></li>
                        <li><a href="/about">关于</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('order.count')}}">订单统计</a></li>
                        <li><a href="{{route('food.count')}}">菜品统计</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('member.index')}}">会员管理</a></li>
                    </ul>
                </li>
                @admin
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">RBAC <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('permission.index') }}">权限列表</a></li>
                        <li><a href="{{ route('role.index') }}">角色列表</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('admin.index') }}">管理员列表</a></li>
                        <li><a href="{{ route('menu.index') }}">菜单列表</a></li>
                    </ul>
                </li>
                @else
                @endadmin
            </ul>--}}
            <ul class="nav navbar-nav">
                {{--调用方法查询父类--}}
                @foreach(\App\Models\Menu::getMenu(0) as $row)
                    <li class="dropdown">
                        @foreach(\App\Models\Menu::getMenu($row->id) as $val)
                        @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->can($val->url))

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $row->name }} <span class="caret"></span></a>
                            @break
                            @endif
                        @endforeach
                            <ul class="dropdown-menu">
                            {{--调用方法查询子类数据--}}
                            @foreach(\App\Models\Menu::getMenu($row->id) as $val)
                                {{--判断当前登录用户有权限再显示--}}
                                @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->can($val->url))
                                <li><a href="{{ route($val->url) }}">{{ $val->name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
            {{--搜索框--}}
            <form class="navbar-form navbar-left" method="get" action="{{--{{ route('good.index') }}--}}">
                <div class="form-group">
                    <input type="text" name="keyword" required class="form-control" placeholder="搜索">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
                {{ csrf_field() }}
{{--                {{ method_field() }}--}}
            </form>
            {{--登录按钮--}}
            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="#" id="click_a"  data-toggle="modal" data-target="#myModal">登录后台</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ \Illuminate\Support\Facades\Auth::user()->name }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admin.edit',\Illuminate\Support\Facades\Auth::user())}}">修改密码</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form action="{{route('logout')}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-link">退出登录</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
                <li>&emsp;</li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>