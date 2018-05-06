<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ShopBusiness;
use App\Models\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shopUsers = ShopUser::paginate(2);
//        dd($shop_users);
        return view('shop.index',compact('shopUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::all();
        return view('shop.create',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email|unique:shop_users',
            'password'=>'required|confirmed|min:6',
            'name'=>'required|min:2',
            'captcha' => 'required|captcha'
        ],[
            'email.email'=>'邮箱地址不合法',
            'password.confirmed'=>'两次密码不一致!',
            'name.min'=>'商铺名称至少2位',
            'captcha.captcha' => '验证码不正确',
        ]);
        DB::transaction(function ()use($request){
            $shop_business = ShopBusiness::create([
                'shop_name'=>$request->name,
                'category_id'=>$request->category_id,
            ]);
            ShopUser::create([
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'business_id'=>$shop_business->id,
            ]);
        });
        return redirect('shop');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShopUser  $shopUser
     * @return \Illuminate\Http\Response
     */
    public function show(ShopUser $shopUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopUser  $shopUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopUser $shop)
    {
//        dd($shopUser);
        $shop_business = $shop->shop_business;
        return view('shop.show',compact('shop','shop_business'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShopUser  $shopUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShopUser $shop)
    {
        $shop->update([
            'status'=>1,
        ]);
        $this->sendEmail($shop->emial,$shop->emial);
        return redirect('shop');
    }
    //发送邮件的方法
    private function sendEmail($email,$name){
        \Illuminate\Support\Facades\Mail::send(
            'mail',//邮件视图模版
            ['name'=>$name],//模版变量赋值
            function ($message) use($email){
                $message->to($email)->subject('审核通过');
        });
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShopUser  $shopUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopUser $shopUser)
    {
        //
    }
}
