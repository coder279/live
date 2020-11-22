<?php

namespace app\common\lib\task;

use app\common\lib\ali\Sms;
use app\common\lib\redis\Predis;
use app\common\lib\Redis;
class Task{
    public function send($data,$ser){

        try{
            $response = Sms::sendSms($data['phone'],$data['code']);
        }catch(\Exception $e){
            return Util::show(1,"阿里内部异常");
        }

        $redis = Predis::getInstance();
        $redis->set(Redis::smsKey($data['phone']),$data['code'],1000);
        return true;
    }

    public function pushLive($data,$ser){
        $clients = Predis::getInstance()->smembers('live_game_key');
        foreach($clients as $fd){
            $ser->push($fd,json_encode($data['data']));
        }
    }
}