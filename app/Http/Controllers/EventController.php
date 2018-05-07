<?php

namespace App\Http\Controllers;

use App\Models\EnevtPrize;
use App\Models\Event;
use App\Models\EventMember;
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
    //查看活动详情有开奖按钮   $lottery活动对象!
    public function lottery(Event $lottery)
    {
//        dd($lottery->id);//获取到这个传过来的参数
        //获取该活动的所有商户user
        $eventMembers = EventMember::where('events_id',$lottery->id)->get();
        if ($eventMembers->count() == 0){
            return [
                'success'=>true,
                'danger'=>'没有活动参与者!',
//                'is_prize'=>'0',
            ];
        }
//        dd($eventMembers);
        //获取所有的奖品
        $eventPrizes = EnevtPrize::where('events_id',$lottery->id)->get();
        $shuffle = $eventMembers->shuffle(); //打乱成一个新的集合!!!!!
//        dd($shuffle->pop(),11,$shuffle);
        foreach ($eventPrizes as $row){  //商户ID保存的是商铺还是商户!
            $pop = $shuffle->pop();
            if ($pop == null){ //如果弹出为空!
                break;
            }
            $row->update([
                'member_id'=>$pop->member_id,
            ]);
        }
        //开完奖 修改活动的 开奖字段is_prize 为1
        $lottery->update([
            'is_prize'=>1,
        ]);
        $data = [
            'success'=>true,
            'danger'=>'摇奖完毕!!',
            'is_prize'=>'1',
        ];
        return $data;
    }
    //获奖名单!!
    public function winnersList(Event $winnersList)
    {
//        dd($winnersList->id);
        $winnersLists = EnevtPrize::where([   //查奖品表
            ['events_id','=',$winnersList->id],   //条件1 活动ID
            ['member_id','<>',0]                  //条件2 奖品有获奖者
        ])->paginate(10);
        return view('event.winnersList',compact('winnersLists'));
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
