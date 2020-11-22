<?php

use app\common\lib\Redis;
use app\common\lib\redis\Predis;

class Ws{
    CONST HOST = '0.0.0.0';
    CONST PORT = '9501';
    CONST CHART_PORT = '9502';

    public $ws = NULL;

    public function __construct(){
        $c = get_called_class();
        $this->ws = new Swoole\WebSocket\Server($c::HOST,$c::PORT);
        $this->ws->listen($c::HOST,$c::CHART_PORT,SWOOLE_SOCK_TCP);
        $this->ws->set([
            'worker_num'    => 4,     // worker process num
            'enable_static_handler' => true,
            'document_root' => '/home/wwwroot/pink/public',
            'task_worker_num' => 4
        ]);
        $this->ws->on("open",[$this,'onOpen']);
        $this->ws->on("message",[$this,'onMessage']);
        $this->ws->on('workerstart',[$this,'onWorkerStart']);
        $this->ws->on('request',[$this,'onRequest']);
        $this->ws->on('task',[$this,'onTask']);
        $this->ws->on('finish',[$this,'onFinish']);
        $this->ws->on('close',[$this,'onClose']);

        $this->ws->start();
    }

    public function onWorkerStart($server,$worker_id){
        define('APP_PATH',__DIR__.'/../../../application/');
        require __DIR__.'/../../../thinkphp/base.php';
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
        $_FILES = [];
        if(isset($request->files)){
            foreach($request->files as $k => $v){
                $_FILES[$k] = $v;
            }
        }
        $_POST = [];
        if(isset($request->post)){
            foreach($request->post as $k => $v){
                $_POST[$k] = $v;
            }
        }
        $this->writeLog();
        $_POST['ws_server'] = $this->ws;
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


    public function onOpen($ws, $request) {
        $predis = app\common\lib\redis\Predis;
        die($predis);
        \app\common\lib\redis\Predis::getInstance()->sadd('live_game_key',$request->fd);
        $ws->push($request->fd, "hello, welcome\n");
    }

    //监听WebSocket消息事件
    public function onMessage ($ws, $frame) {
        echo "Message: {$frame->data}\n";
        $ws->push($frame->fd, "server: {$frame->data}");
    }


    /**
     * 监听ws关闭事件
     *
     * @param $ws
     * @param $fd
     */
    public function onClose($ws,$fd){
        \app\common\lib\redis\Predis::getInstance()->srem('live_game_key',$fd);
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
        $flag = $obj->$method($data,$ws);
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

    public function writeLog($serv){
        $datas = array_merge(['date' => date('Ymd H:i:s')],$_GET,$_POST,$_SERVER);

        $logs = '';
        foreach ($datas as $k => $v){
            $logs.= $k . ":" . $v . " ";
        }
        \Swoole\Coroutine\System::fwrite(APP_PATH.'../runtime/log/'.date('Ym').'/'.date('d')."_access.log",$logs.PHP_EOL,0);
    }

}

$web = new ws();

//netstat -anp |grep 9501 swoole定时器
