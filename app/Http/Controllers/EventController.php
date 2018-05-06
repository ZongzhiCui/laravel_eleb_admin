<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * DAY12 活动管理
     */
    public function index()
    {
        $activitys = Event::orderBy('id','desc')->paginate(3);
        return view('event.index',compact('activitys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
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
            'title'=>'required',
            'signup_start'=>'required|date|after:today',
            'signup_end'=>'required|date|after:today',
            'prize_date'=>'required|date|after:today',
            'signup_num'=>'required',
        ],[
            'start_time.after'=>'起始日期必须是今天之后!'
        ]);
//        dd($request->start_time);
        Event::create([
            'title'=>$request->title,
            'content'=>$request->contents??0,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
        ]);
        return redirect('event')->with('success','添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('event.show',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->validate($request,[
            'title'=>'required',
            'signup_start'=>'required|date|after:today',
            'signup_end'=>'required|date|after:today',
            'prize_date'=>'required|date|after:today',
            'signup_num'=>'required',
        ],[
            'start_time.after'=>'起始日期必须是今天之后!'
        ]);
//        dd($request->start_time);
        $event->update([
            'title'=>$request->title,
            'content'=>$request->contents??0,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>intval($request->is_prize),
        ]);
        return redirect('event')->with('success','修改成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if ($event->prize_date > date('Y-m-d')){
            return ['success'=>false,'danger'=>'该活动还没有开奖,禁止删除!'];
        }
        $event->delete();
    }
}
