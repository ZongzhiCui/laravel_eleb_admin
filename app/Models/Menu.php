<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    //显示header头的数据 菜单分类
    static public function getMenu($pkey)
    {
        $menus = self::where('pkey',$pkey)->orderBy('sort')->get();
        return $menus;
    }
}
