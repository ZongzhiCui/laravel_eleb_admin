<?php

namespace App\Http\Controllers;

use App\Models\EnevtPrize;
use App\Models\Event;
use Illuminate\Http\Request;

class EnevtPrizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventPrizes = EnevtPrize::orderBy('id','desc')->paginate(10);
        return view('eventPrize.index',compact('eventPrizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Event::all();
        return view('eventPrize.create',compact('events'));
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
            'events_id'=>'required',
            'name'=>'required',
            'num'=>[
                'required','regex:/^[1-9][0-9]{0,2}$/'
            ],
        ],[
            'num.regex'=>'奖品数量范围在1到999',
        ]);
//        dd($request->start_time);
        for ($i=1;$i<=$request->num;++$i) {
            EnevtPrize::create([
                'events_id'=>$request->events_id,
                'name'=>$request->name,
                'description'=>$request->description??'',
            ]);
        }
        return redirect('eventPrize')->with('success','添加成功!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnevtPrize  $enevtPrize
     * @return \Illuminate\Http\Response
     */
    public function show(EnevtPrize $eventPrize)
    {
        return view('eventPrize.show',compact('eventPrize'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnevtPrize  $enevtPrize
     * @return \Illuminate\Http\Response
     */
    public function edit(EnevtPrize $eventPrize)
    {
        $events = Event::all();
        return view('eventPrize.edit',compact('eventPrize','events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnevtPrize  $enevtPrize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnevtPrize $eventPrize)
    {
        $this->validate($request,[
            'events_id'=>'required',
            'name'=>'required',
            /*'num'=>[
                'required','regex:/^[1-9][0-9]{0,2}$/'
            ],*/
        ],[
            'num.regex'=>'奖品数量范围在1到999',
        ]);
//        dd($request->start_time);
            $eventPrize->update([
                'events_id'=>$request->events_id,
                'name'=>$request->name,
                'description'=>$request->description??'',
            ]);
        return redirect('eventPrize')->with('success','修改成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnevtPrize  $enevtPrize
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnevtPrize $eventPrize)
    {
        if ($eventPrize->member_id == 0){
            return ['success'=>false,'danger'=>'该奖品还没有获奖者不能删除'];
        }
        $eventPrize->delete();
    }
}
