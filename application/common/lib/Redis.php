<?php

namespace app\common\lib;

class Redis{
    //redis key前缀
    public static $pre = "sms_";

    //user key前缀
    public static $user_pre = "user_";
    /**
     * 存储手机验证码
     * @param $phone
     */
    public static function smsKey($phone){
        return self::$pre.$phone;
    }

    public static function userKey($phone){
        return self::$user_pre.$phone;
    }
}