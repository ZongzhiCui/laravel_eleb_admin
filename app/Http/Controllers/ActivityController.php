<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activitys = Activity::orderBy('id','desc')->paginate(3);
        return view('activity.index',compact('activitys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activity.create');
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
            'title'=>'required',
            'start_time'=>'required|date|after:today',
            'end_time'=>'required|date|after:today',
        ],[
            'start_time.after'=>'起始日期必须是今天之后!'
        ]);
//        dd($request->start_time);
        Activity::create([
            'title'=>$request->title,
            'content'=>$request->contents??0,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
        return redirect('activity');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return view('activity.show',compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        return view('activity.edit',compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $this->validate($request,[
            'title'=>'required',
            'start_time'=>'required|date|after:today',
            'end_time'=>'required|date|after:today',
        ],[
            'start_time.after'=>'起始日期必须是今天之后!'
        ]);
        Activity::create([
            'title'=>$request->title,
            'content'=>$request->contents??0,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
        return redirect('activity');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        if (date('Y-m-d')<$activity->end_time){
            return ['success'=>false,'danger'=>'该活动还在活动期间,禁止删除'];
        }
        $activity->delete();
    }
}
