<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMember extends Model
{
    protected $guarded = [];
    public function event()
    {
        return $this->belongsTo(Event::class,'events_id')->withDefault([
            'title'=>'默认新活动!'
        ]);
    }

    public function user()
    {
        return $this->belongsTo(ShopUser::class,'member_id')->withDefault([
            'email'=>'默认未分配中奖人!'
        ]);
    }
}
