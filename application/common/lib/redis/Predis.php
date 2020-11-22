<?php
namespace app\common\lib\redis;

class Predis{
    private static $_instance = null;
    public $redis = "";

    public static function getInstance(){
        if(empty(self::$_instance)){
           return self::$_instance = new self();
        }
        return self::$_instance;
    }
    private function __construct(){
       $this->redis = new \Redis();
       $result = $this->redis->connect('127.0.0.1',6379,5);
       if($result === false){
           throw new \Exception('redis connect error');
       }
    }
    /**
     * redis 设置数据
     * @param $key
     * @param $value
     * @param int $time
     * @return bool string
     */
    public function set($key,$value,$time = 0){
        if(!$key){
            return '';
        }
        if(is_array($value)){
            $value = json_encode($value);
        }
        if(!$time){
            return $this->redis->set($key,$value);
        }
        return $this->redis->setex($key,$time,$value);
    }
    /**
     * redis get数据
     * @param $key
     * @return string
    */
    public function get($key){
        if(!$key){
            return '';
        }
        $str = $this->redis->get($key);
        return $str;

    }
    /**
     * @param $key
     * @param $value
     * @return mixed
    */
    public function sadd($key,$value){
        return $this->redis->sAdd($key,$value);
    }
    /**
     * @param $key
     * @param $value
     * @return mixed
    */
    public function srem($key,$value){
        return $this->redis->sRem($key,$value);
    }
    /**
     *
    */
    public function smembers($key){
        return $this->redis->sMembers($key);
    }

    public function __call($name,$args){
        if(count($args) != 2){
            return '';
        }
         $this->redis->$name($args[0],$args[1]);
    }

}
