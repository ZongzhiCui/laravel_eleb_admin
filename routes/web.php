<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//后台登录
Route::get('login','LoginController@create')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::delete('logout','LoginController@destroy')->name('logout');

//验证登录中间件
Route::group(['middleware'=>['adminLogin','role:general|super']],function (){
//商铺分类表
Route::get('/','CategoryController@index')->name('/');//暂时首页跳到分类列表
Route::resource('category','CategoryController');

//后台添加商户
Route::resource('shop','ShopUserController');
//后台管理员
Route::resource('admin','AdminController');
//审查在shop.edit

//阿里云OSS转存储文件
Route::get('/oss', function()
{
    $client = App::make('aliyun-oss');
//    $client->putObject(getenv('OSS_BUCKET'), "eleb/admin/2.txt", "上传文件3个参数:BUCKET名,文件名,文件内容");
//    $result = $client->getObject(getenv('OSS_BUCKET'), "eleb/admin/2.txt");
//    echo $result;
    //将D:\www\eleb\eleb_admin\storage\app\public\date0420\Ff103nyL0Sgq3k1Qb0FwqyRIClnqSyFtSxq7yDqX_180X180.jpeg
    //上传到阿里云OSS服务器
    try{
        $client->uploadFile(getenv('OSS_BUCKET'),
            'eleb/admin/public\date0420\Ff103nyL0Sgq3k1Qb0FwqyRIClnqSyFtSxq7yDqX_180X180.jpeg',
            storage_path('app\public\date0420\Ff103nyL0Sgq3k1Qb0FwqyRIClnqSyFtSxq7yDqX_180X180.jpeg'));
        echo '上传成功';
        //访问文件的地址
        //https://tina-laravel.oss-cn-beijing.aliyuncs.com/eleb/admin/
        //urlencode('public\date0422\SuncCvPZ1aSE7FjfUB2Zz7LrI39MGgrKnhhmzMSQ.jpeg');
    } catch(\OSS\Core\OssException $e) {
        printf(__FUNCTION__ . ": FAILED\n");
        printf($e->getMessage() . "\n");
        echo '上传失败';
        return;
    }
});

//活动列表
Route::resource('activity','ActivityController');

//订单量统计
//订单统计
Route::get('/orderCount','CountController@orderCount')->name('order.count');
//订单查询
Route::post('/orderTime','CountController@orderTime')->name('order.time');

//菜品统计
Route::get('/foodCount','CountController@foodCount')->name('food.count');
//菜品查询
Route::post('/foodTime','CountController@foodTime')->name('food.time');

//会员管理
Route::resource('member','MemberController');

//DAY12 活动管理
    //抽奖活动表 events
    Route::resource('event','EventController');
    //查看抽奖活动有一个开奖按钮 传的是活动对象
    Route::get('/lottery/{lottery}','EventController@lottery')->name('lottery');
    //获奖名单按钮!!传的是活动对象
    Route::get('/winnersList/{winnersList}','EventController@winnersList')->name('winnersList');
    //抽奖活动奖品表 enevt_prize
    Route::resource('eventPrize','EnevtPrizeController');
    //活动报名表 event_members
    Route::resource('eventMember','EventMemberController');


/*//发送邮件
    Route::get('/mail',function(){
        \Illuminate\Support\Facades\Mail::send(
            'mail',//邮件视图模版
            ['name'=>'张三'],//模版变量赋值
            function ($message){
                $message->to('cfq850228@163.com')->subject('订单确认');
            });
        return '邮件发送成功!!!';
    });*/

});


//示例 中间件
//Route::get('admin','AdminController@index')->middleware('role:admin|lisi|zhangsan');
//视图模版
//@role('admin')
//<p>This is visible to users with the admin role. Gets translated to
//\Laratrust::hasRole('admin')</p>
//@endrole
//
//@permission('manage-admins')
//<p>This is visible to users with the given permissions. Gets translated to
//\Laratrust::can('manage-admins'). The @can directive is already taken by core
//    laravel authorization package, hence the @permission directive instead.</p>
//@endpermission
//权限限制
Route::group(['middleware' => ['role:super']], function() { //permission:admin.create
    //RBAC   RBAC
//权限管理
    Route::resource('permission','PermissionController');
//角色管理
    Route::resource('role','RoleController');
//管理员管理
    //修改回显
    Route::get('admin/{admin}/editPermission','AdminController@editPermission')->name('admin.editPermission');
    //修改保存
    Route::put('admin/{admin}','AdminController@updatePermission')->name('admin.updatePermission');
    //菜单管理
    Route::resource('menu','MenuController');

});

//测试 管理员角色
Route::get('/test',function (){
    $user = \Illuminate\Support\Facades\Auth::user();
    dump($user);
    $a = $user->hasRole('super');
    dd($a);
});
//测试 中文分词搜索
Route::get('/search',function (){
    $cl = new \App\SphinxClient();
    $cl->SetServer ( '127.0.0.1', 9312);
//$cl->SetServer ( '10.6.0.6', 9312);
//$cl->SetServer ( '10.6.0.22', 9312);
//$cl->SetServer ( '10.8.8.2', 9312);
    $cl->SetConnectTimeout ( 10 );
    $cl->SetArrayResult ( true );
// $cl->SetMatchMode ( SPH_MATCH_ANY);
    $cl->SetMatchMode ( SPH_MATCH_EXTENDED2);
    $cl->SetLimits(0, 1000);
    $info = '小厨';
    $res = $cl->Query($info, 'shops');//搜索的索引名称 csft.conf里设置的名字
//print_r($cl);
    if ($res['total']>0){
        $ids = collect($res['matches'])->pluck('id'); //得到ID数组
        //写构造器 查询所有ID的数据
//        dd($ids);
        $data = \App\Models\ShopBusiness::whereIn('id',$ids)->get();
//        dd($data);
    }else{
        //没有搜索到你找的内容
        echo 'null';
    }
//    print_r($res);
});

