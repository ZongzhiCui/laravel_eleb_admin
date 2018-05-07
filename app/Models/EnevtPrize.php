<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnevtPrize extends Model
{
    protected $guarded = [];
    public function event()
    {
        return $this->belongsTo(Event::class,'events_id')->withDefault([
            'title'=>'默认新活动!'
        ]);
    }

    public function business()
    {
        return $this->belongsTo(ShopUser::class,'member_id')->withDefault([
            'shop_name'=>'默认未分配中商铺!'
        ]);
    }
}
