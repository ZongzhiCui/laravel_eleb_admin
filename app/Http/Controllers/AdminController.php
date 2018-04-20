<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return '<h1>管理员首页!</h1>';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()){
            return redirect('user');
        }
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->name,$request->password);
        $this->validate($request,[
            'name'=>'required',
        ],[

        ]);
        Admin::create([
            'name'=>$request->name??'admin',
            'password'=>bcrypt($request->password)??bcrypt(123456),
        ]);
        return redirect('login')->with('success','添加管理成功!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $this->validate($request,[
            'oldpassword'=>'required',
            'password'=>'required|confirmed',
        ],[
            'oldpassword.required'=>'旧密码必须填写',
            'password.required'=>'新密码必须填写',
            'password.confirmed'=>'确认密码与新密码不一致',
        ]);
//        dd(Auth::user()->password,$admin->password);
        if(!Hash::check($request->oldpassword, Auth::user()->password)){
            echo '旧密码错误!';
        }
        $admin->update([
            'password'=>bcrypt($request->password),
        ]);
        Auth::logout();
        return redirect('login');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
