<?php

use app\common\lib\Redis;

class HTTP{
    CONST HOST = '0.0.0.0';
    CONST PORT = '9501';

    public $http = NULL;

    public function __construct(){
        $c = get_called_class();
        $this->http = new Swoole\Http\Server($c::HOST,$c::PORT);

        $this->http->set([
            'worker_num'    => 4,     // worker process num
            'enable_static_handler' => true,
            'document_root' => '/home/wwwroot/pink/public/live',
            'task_worker_num' => 4
        ]);
        $this->http->on('workerstart',[$this,'onWorkerStart']);
        $this->http->on('request',[$this,'onRequest']);
        $this->http->on('task',[$this,'onTask']);
        $this->http->on('finish',[$this,'onFinish']);
        $this->http->on('close',[$this,'onClose']);

        $this->http->start();
    }

    public function onWorkerStart($server,$worker_id){
        define('APP_PATH',__DIR__.'/../application/');
        require __DIR__.'/../thinkphp/base.php';
    }
    /**
     *  request 回调函数
    */
    public function onRequest($request,$response){
        $_SERVER = [];
        if(isset($request->server)){
            foreach($request->server as $k => $v){
                $_SERVER[strtoupper($k)] = $v;
            }
        }
        $_SERVER = [];
        if(isset($request->header)){
            foreach($request->header as $k => $v){
                $_SERVER[strtoupper($k)] = $v;
            }
        }
        $_GET = [];
        if(isset($request->get)){
            foreach($request->get as $k => $v){
                $_GET[$k] = $v;
            }
        }
        $_POST = [];
        if(isset($request->post)){
            foreach($request->post as $k => $v){
                $_POST[$k] = $v;
            }
        }
        $_POST['http_server'] = $this->http;
        ob_start();
        try{
            think\Container::get('app',[APP_PATH])->run()->send();
        }
        catch(Exception $e){
            //todo
        }
        // 执行应用并响应
        $res = ob_get_contents();
        if(ob_get_length() > 0) {
            ob_clean();
        }
        $response->header("Content-Type", "text/html; charset=utf-8");
        $response->end($res);
    }


    /**
     * 监听ws关闭事件
     *
     * @param $ws
     * @param $fd
     */
    public function onClose($ws,$fd){
        echo "clientid:{$fd}\n";
    }
    /**
     * 异步监听ws事件
     *
     * @param $ws
     * @param $task_id
     * @param $from_id
     * @param $data
     *
     */
    public function onTask($ws,$task_id,$from_id,$data){
        $obj = new app\common\lib\task\Task;
        $method = $data['method'];
        $flag = $obj->$method($data);
        return $flag;
    }
    /**
     * task结束事件
     *
     * @param $ws
     * @param $task_id
     * @param $data task函数返回的消息
     */
    public function onFinish($ws,$task_id,$data){
        echo "task_id:{$task_id}\n";
        echo "finish-data-success:{$data}\n";
    }

}

$web = new HTTP();