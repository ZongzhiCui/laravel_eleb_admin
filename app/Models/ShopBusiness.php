<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopBusiness extends Model
{
    protected $fillable = [
        'shop_name','shop_img','shop_rating','brand','on_time','fengniao','category_id',
        'bao','zhun','start_send','send_cost','estimate_time','notice','discount',
    ];

}
