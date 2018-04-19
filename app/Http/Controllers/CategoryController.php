<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::paginate(2);
        return view('Category.index',compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Category/create');
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
            'name'=>'required|min:2',
            'logo'=>'required|image',
        ],[
            'name.required'=>'分类名称不能为空!',
            'name.min'=>'分类名称至少2位',
            'logo.image'=>'必须上传图片格式',
        ]);
        $thumb = 180;
        $filename = $request->file('logo')->store('public/date'.date('md'));
        $path_parts = pathinfo(Storage::url($filename));
        $i_mg = $path_parts['dirname'].'/'.$path_parts['filename'].'_'.$thumb.'X'.$thumb.'.'.$path_parts['extension'];
        $img = Image::make(public_path().Storage::url($filename))->resize($thumb, $thumb);
        $img->save(public_path().$i_mg);
        Category::create([
            'name'=>$request->name,
            'logo'=>$i_mg,
        ]);
        session()->flash('success','分类添加成功!');
        return redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('Category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('Category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name'=>'required|min:3',
            'logo'=>'required|image',
        ],[
            'name.required'=>'分类名称不能为空!',
            'name.min'=>'分类名称至少3位',
            'logo.image'=>'必须上传图片格式',
        ]);
        $thumb = 180;
        $filename = $request->file('logo')->store('public/date'.date('md'));
        $path_parts = pathinfo(Storage::url($filename));
        $i_mg = $path_parts['dirname'].'/'.$path_parts['filename'].'_'.$thumb.'X'.$thumb.'.'.$path_parts['extension'];
        $img = Image::make(public_path().Storage::url($filename))->resize($thumb, $thumb);
        $img->save(public_path().$i_mg);
        $category->update([
            'name'=>$request->name,
            'logo'=>$i_mg,
        ]);
        session()->flash('success','分类名称修改成功!');
        return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
    }
}
