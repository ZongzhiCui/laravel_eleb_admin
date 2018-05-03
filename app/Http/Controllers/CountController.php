<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CountController extends Controller
{
    /**
    - 订单量统计[按商家分别统计和整体统计]（每日、每月、总计） 
    - 菜品销量统计[按商家分别统计和整体统计]（每日、每月、总计） 
     */
    public function orderCount()
    {
        $total = DB::select("select shop_id,count('id') as m from `orders` group by shop_id");
        $count1 = DB::select("select count('id') as m from `orders`")[0]->m;
        $month = DB::select("select shop_id,count('id') as m from `orders` where created_at like ? group by shop_id",[date('Y-m').'%']);
        $count2 = DB::select("select count('id') as m from `orders` where created_at like ? ",[date('Y-m').'%'])[0]->m;
        $day = DB::select("select shop_id,count('id') as m from `orders` where created_at like ? group by shop_id",[date('Y-m-d').'%']);
        $count3 = DB::select("select count('id') as m from `orders` where created_at like ? ",[date('Y-m-d').'%'])[0]->m;
        return view('count.orderCount',compact('total','count1','month','count2','day','count3'));
    }

    //按时间查看订单统计
    public function orderTime(Request $request)
    {
//            return back()->withInput()->with('danger','请输入要搜索的日期!');
        $this->validate($request,[
            'datetime1'=>'required',
            'datetime2'=>'required',
        ],[
            
        ]);
            $date = $request->datetime1;
            $date1 = $request->datetime2;
            $count = DB::select("select shop_id,count('id') as m from `orders` where created_at between ? and ? GROUP BY shop_id",[$date,$date1.' 23:59:59']);
            $count1 = DB::select("select count('id') as m from `orders` where created_at between ? and ?",[$date,$date1.' 23:59:59'])[0]->m;
        return view('count.orderTime',compact('count','count1'));
    }

    /**- 菜品销量统计[按日统计,按月统计,累计]（每日、每月、总计） **/
    //菜品统计
    public function foodCount()
    {
        //查询当前用户的店铺id
        $shop_ids = DB::select('select shop_id from `orders` group by shop_id');
//        dd($shop_ids);
        $ids = [];
        foreach ($shop_ids as $value){
            //遍历店铺ID 获取到所有店铺对应的所有订单ID
            $ids[] = DB::table('orders')->where('shop_id',$value->shop_id)->get();
            //后添加把店铺名字加到shop_ids里
            $value->shop_name = DB::select('select DISTINCT shop_name from `orders` where shop_id='.$value->shop_id)[0]->shop_name;
        }
//        dd($ids);
        //遍历出商铺
        foreach ($ids as $val){ 
            $num = [];
            //遍历出该商铺的订单ID
            foreach ($val as $va){
                $num[] = $va->id;
            }
            $str = implode(',',$num);
            static $total = [];
            static $month = [];
            static $day = [];
            $total[] = DB::select("select foods_id,sum(foods_amount) as total from `order_foods` where order_id in ($str) GROUP by `foods_id` order BY total desc");
            $month[] = DB::select("select foods_id,sum(foods_amount) as m from `order_foods` WHERE order_id in ($str) and created_at like ? GROUP by `foods_id` order BY m desc",[date('Y-m').'%']);
            $day[] = DB::select("select foods_id,sum(foods_amount) as d from `order_foods` where order_id in ($str) and created_at like ? GROUP by `foods_id` order BY d desc",[date('Y-m-d').'%']);
        }
        
        $total = array_filter($total);
        $month = array_filter($month);
        $day = array_filter($day);
        /**遍历每条数据把菜品名字写进去  start**/
        foreach ($total as $val1){
            foreach ($val1 as $v1){
                $v1->foods_id = DB::table('order_foods')->where('foods_id',$v1->foods_id)->first()->foods_name;
            }
        }
        foreach ($month as $val2){
            foreach ($val2 as $v2){
                $v2->foods_id = DB::table('order_foods')->where('foods_id',$v2->foods_id)->first()->foods_name;
            }
        }
        foreach ($day as $val3){
            foreach ($val3 as $v3){
                $v3->foods_id = DB::table('order_foods')->where('foods_id',$v3->foods_id)->first()->foods_name;
            }
        }
        /**遍历每条数据把菜品名字写进去  end**/


        /**统计出总计的数量  start**/
        $totalCount = 0;
        $monthCount = 0;
        $dayCount = 0;
        $totalCount += DB::select("select sum(foods_amount) as total from `order_foods`")[0]->total;
        $monthCount += DB::select("select sum(foods_amount) as m from `order_foods` where created_at like ?",[date('Y-m').'%'])[0]->m;
        $dayCount += DB::select("select sum(foods_amount) as d from `order_foods` where created_at like ?",[date('Y-m-d').'%'])[0]->d;
        /**统计出总计的数量  start**/
//        dd($totalCount,$monthCount,$dayCount);
        
//        dd($shop_ids,$day,$month,$total);
        return view('count.foodCount',compact('shop_ids','total','month','day','totalCount','monthCount','dayCount'));
    }
    //按时间查看订单统计
    public function foodTime(Request $request)
    {
        $this->validate($request,[
            'datetime1'=>'required',
            'datetime2'=>'required',
        ],[
            
        ]);
        $date = $request->datetime1;
        $date1 = $request->datetime2;
        //查询当前用户的店铺的订单id
        $shop_ids = DB::select('select shop_id from `orders` group by shop_id');
//        dd($shop_ids);
        $ids = [];
        foreach ($shop_ids as $value){
            $ids[] = DB::table('orders')->where('shop_id',$value->shop_id)->get();
            //后添加把店铺名字加到shop_ids里
            $value->shop_name = DB::select('select DISTINCT shop_name from `orders` where shop_id='.$value->shop_id)[0]->shop_name;
        }
        //遍历出商铺
        foreach ($ids as $val) {
            $num = [];
            //遍历出该商铺的订单ID
            foreach ($val as $va) {
                $num[] = $va->id;
            }
            $str = implode(',', $num);
            static $count = [];
            $count[] = DB::select("select foods_id,sum(foods_amount) as d from `order_foods` where order_id in ($str) and created_at between ? and ? GROUP by `foods_id` order BY d desc", [$date, $date1.' 23:59:59']);
        }
        $count = array_filter($count);
        /**遍历每条数据把菜品名字写进去  start**/
        foreach ($count as $val1){
            foreach ($val1 as $v1){
                $v1->foods_id = DB::table('order_foods')->where('foods_id',$v1->foods_id)->first()->foods_name;
            }
        }
        /**遍历每条数据把菜品名字写进去  end**/
        
        /**计算搜索的总计量 start**/
        $count1 = DB::select("select sum(foods_amount) as d from `order_foods` where created_at between ? and ?", [$date, $date1.' 23:59:59'])[0]->d;
        /**计算搜索的总计量 end**/
        
//        dd($shop_ids,$count);
        return view('count.foodTime',compact('shop_ids','count','count1'));
    }
}
