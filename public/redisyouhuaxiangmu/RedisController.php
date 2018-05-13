<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RedisController extends Controller
{
    //解决大并发下,报名人数超出问题
    public function baoming(Event $event)
    {
        $redis = new \Redis();
        //将活动人数限制,保存到redis(添加活动时) 'signup_num_'.$event->id = 10
        //报名
        //获取当前活动的人数限制
        $limit = $redis->get('signup_num_'.$event->id);
        //从redis去判断报名人数
        /*$num = $redis->get('num_'.$event->id);
        if($num >= $limit){
            echo '报名人数已满';exit;
        }
        $redis->incr('num_'.$event->id);*/

        $num = $redis->incr('num_'.$event->id);
        if($num > $limit){
            $redis->decr('num_'.$event->id);
            echo '报名人数已满';exit;
        }
        //保存报名信息[ 1 ,6 ,8 ]
        //$redis->hSet('');
        $redis->sAdd('members_'.$event->id,Auth::user()->id);

        //同步回数据库(第二条凌晨3:00)

    }

    //商家列表接口
    public function shops()
    {
        //$shops = DB::table('shops')->get();
        //使用redis做缓存
        $redis = new \Redis();
        $data = $redis->get('shops');
        if($data === false){
            //缓存不存在,重新生成缓存
            $shops = DB::table('shops')->get();
            $redis->set('shops',serialize($shops),3600);
        }else{
            $shops = unserialize($data);
        }
        return $shops;
    }

    public function shop(Shop $shop)
    {

    }


    //后台修改商家信息(添加 修改 删除)
    public function add()
    {

        //操作完商家信息之后
        $redis = new \Redis();
        $redis->delete('shops');
    }

    //清理超时未支付订单
    public function cleanOrder()
    {
        //设置脚本永不超时
        set_time_limit(0);
        //1分钟 3秒
        while (1){
            //24小时未支付,算超时
            DB::table('orders')->where([
                ['status'=>0],
                ['created_at','<',date('Y-m-d H:i:s',strtotime('-1 day'))]//当前时间-下单时间 > 24小时  ==> 下单时间 < 当前时间-24小时
            ])->update(['status'=>-1]);
            sleep(3);
        }

    }

    //接口token认证
    public function login()
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1');
        //认证账号密码
        $credentials = [
            'name'=>'shop@qq.com',
            'password'=>'123456'
        ];
        if ($user = Auth::once($credentials)) {
            //
            //dd(Auth::user());
            $token = md5(Auth::user()->id.time());
            //dd($token);
            $redis->set($token,Auth::user()->id,7*24*3600);
            return json_encode([
                'error'=>false,
                'msg'=>'登录成功',
                'token'=>$token,
                'expire'=>7*24*3600+time(),
                'data'=>Auth::user()
            ]);
        }
        //dd($user);
    }
    //当前 登录用户的地址列表
    public function addresses(Request $request)
    {
        $token = $request->token;
        $user_id = $request->user_id;
        //验证token和用户id是否正确
        $redis = new \Redis();
        $redis->connect('127.0.0.1');
        $id = $redis->get($token);
        if($id && $id==$user_id){
            //续期token
            $redis->expire($token,7*24*3600);
            //token和user_id一致
            $addresses = DB::table('addresses')->where('user_id',$user_id)->get();
            return json_encode([
                'error'=>false,
                'msg'=>'请求成功',
                'data'=>$addresses
            ]);
        }else{
            //token验证失败,请重新获取
            return json_encode([
                'error'=>100,
                'msg'=>'token验证失败,请重新获取',
            ]);
        }
    }

    //数字签名 /member?id=1&type=2&time=1323123123123&sign=
    //客户端签名方法
    public function sign()
    {
        $secret = '好好学习34859寒假#@%&你还记得吧';
        $data = [
            'id'=>1,
            'type'=>2,
            'time'=>time()
        ];
        ksort($data);//按key升序排列 id time type
        $str = '';
        foreach ($data as $key=>$value){
            $str .= $key.$value;
        }
        $str .= $secret;
        $sign = strtoupper(md5($str));
        // /member?id=1&type=2&time= time() & sign = $sign
    }


    //服务器端验证签名
    public function member(Request $request)
    {
        //验证请求是否过期  time - time()  绝对值大于 5*60秒,过期
        //验证签名
        $secret = '好好学习34859寒假#@%&你还记得吧';
        $data = $request->input();//[id=1&type=2&time= time() & sign = $sign]
        $s = $request->sign;
        unset($data['sign']);
        ksort($data);//按key升序排列 id time type
        $str = '';
        foreach ($data as $key=>$value){
            $str .= $key.$value;
        }
        $str .= $secret;
        $sign = strtoupper(md5($str));
        if($s == $sign){
            //验证成功
            //正常调接口
        }else{
            //签名不正确
        }
    }

}
