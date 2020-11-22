<?php
$http = new Swoole\Http\Server('0.0.0.0', 9501);
/**
 * 开启HTTP请求4个进程
 */
$http->set([
    'worker_num'    => 4,     // worker process num
    'enable_static_handler' => true,
    'document_root' => '/home/wwwroot/pink/public/live'
]);

$http->on('WorkerStart',function(swoole_server $server,$worker_id){
    define('APP_PATH',__DIR__.'/../application/');
    require __DIR__.'/../thinkphp/base.php';
});
/**
 * HTTP请求是单向的，只关注请求响应就可以
 * 1.$request->server 请求的内容
 * 2.$response 响应的内容
 * 3.end向客户端发送数据
 */
$http->on('request', function ($request, $response)use($http) {
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
    //$http->close($response->fd);
});
/**
 * HTTP开启
 */
$http->start();