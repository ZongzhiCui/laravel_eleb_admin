<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 角色管理..其中事务没有效果 因为数据库是myisam
     */
    public function index()
    {
        $roles = Role::paginate(8);
        return view('role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('name','asc')->get();
//        $permissions = Permission::all();
//        dd($permissions);
        return view('role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->except('_token','role'));
        $this->validate($request,[
            'name'=>'required',
        ],[]);
        DB::transaction(function ()use($request){
            $owner = Role::create($request->except('_token','role'));
            $owner->syncPermissions($request->role);
        });
//        return back()->withInput()->with('danger','输入错误!极低几率出现');
        return redirect('role')->with('success','成功!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('role.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name','asc')->get();
        /*$permissionss = $role->permissions;
        $ids = [];
        foreach ($permissionss as $v){
            $ids[] = $v->id;
        }
         写在视图:{{in_array($row->id,$ids)?'checked':''}} */
//        dd($ids);
        return view('role.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
//        dd($request->except(['_token','_method','role']));
        $this->validate($request,[
            'name'=>'required',
        ],[]);
        DB::transaction(function ()use($request,$role){
            $role->update($request->except(['_token','_method','role']));
            $role->syncPermissions($request->role);
        });

        return redirect('role')->with('success','成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        DB::transaction(function ()use($role){
            $role->delete();
            $role->syncPermissions([]);
        });
        return json_encode(['success','成功!']);
    }
}
