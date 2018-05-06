<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private function getChildren($categoryList,$pkey,$deep=0){
        static $children = [];//保存找到的儿子
        //循环所有的数据，比对每条数据中的parent_id,如果等于传入的$parent_id说明儿子找到了
        foreach ($categoryList as $child){
            if($child['pkey'] == $pkey){
                //将找到的儿子保存到数组中
                $child['name_txt'] = str_repeat("○",$deep*2).$child['name'];//保存有缩进的名称
                $children[] = $child;//节点AAA
                //由于找到的 节点AAA 它还有儿子 继续查找
                $this->getChildren($categoryList,$child['id'],$deep+1);
            }
        }
        //返回找到的儿子
        return $children;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate(10);
//        $menus = $this->getChildren(Menu::all(),0);
        return view('menu.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = $this->getChildren(Menu::all(),0);;
        return view('menu.create',compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->input());
        $this->validate($request,[
            'name' => 'required',
            'pkey' => 'required',
            'url' => 'required',
            'sort' => 'required',
        ],[

        ]);
        Menu::create($request->except('_token'));
        return redirect('menu')->with('success','成功!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view('menu.show',compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $menus = $this->getChildren(Menu::all(),0);;
        return view('menu.edit',compact('menus','menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menu->update($request->except('_token','_method'));
        return redirect('menu')->with('success','成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
    }
}
