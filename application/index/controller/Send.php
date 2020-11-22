<?php

namespace app\index\controller;

use app\common\lib\Util;

class Send{
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
}