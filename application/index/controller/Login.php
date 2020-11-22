<?php

namespace app\index\controller;
use app\common\lib\Util;
use app\common\lib\ali\Sms;
use app\common\lib\Redis;
use app\common\lib\redis\Predis;

class Login{

    public function index(){
        $phoneNum = request()->param('phone_num');
        if(empty($phoneNum)){
            return Util::show(0,"电话号码为空");
        }
        $code = rand(1000,9999);
        $task_data = [
            "phone" => $phoneNum,
            "code" => $code,
            "method" => 'send'
        ];
        $_POST['http_server']->task($task_data);
//        try{
//            //$response = Sms::sendSms($phoneNum,$code);
//        }catch(\Exception $e){
//            return Util::show(1,"阿里内部异常");
//        }

        return Util::show(0,'发送成功');

    }

    public function login(){

        //phone code
        $phoneNum = $_GET['phone_num'];
        $code = $_GET['code'];
        var_dump($code);
        if(empty($phoneNum) || empty($code)){
            return Util::show(1,"请输入完整信息");
        }
        $redis = Predis::getInstance();
        $code_o = $redis->get(Redis::smsKey($phoneNum));
        var_dump($code_o);
        //redis.so
        if($code_o == $code){
            $data = [
                'user' => $phoneNum,
                'srcKey' => md5(Redis::userKey($phoneNum)),
                'time' => time(),
                'is_login' => true
            ];
            Predis::getInstance()->set(Redis::userKey($phoneNum),$data);
            return Util::show(0,"ok",$data);
        }else{
            return Util::show(1,"登陆失败");
        }
    }
}