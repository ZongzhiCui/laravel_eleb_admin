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

//发送邮件
    Route::get('/mail',function(){
        \Illuminate\Support\Facades\Mail::send(
            'mail',//邮件视图模版
            ['name'=>'张三'],//模版变量赋值
            function ($message){
                $message->to('cfq850228@163.com')->subject('订单确认');
            });
        return '邮件发送成功!!!';
    });

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

