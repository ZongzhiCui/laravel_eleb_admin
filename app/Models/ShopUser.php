<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopUser extends Model
{
    protected $fillable = [
        'email','password','status','business_id',
    ];

    public function shop_business()
    {
        return $this->belongsTo(ShopBusiness::class,'business_id')->withDefault([
            'id' => '',
        ]);
    }
}
