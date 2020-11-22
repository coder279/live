<?php

namespace app\index\controller;

use app\common\lib\Util;

class Chart{

    public function index(){
        if(empty($_POST['game_id'])){
            return Util::show(1,'error');
        }
        if(empty($_POST['content'])){
            return Util::show(1,'error');
        }
        $data = [
            "user" => "用户".rand(10000,99999),
            "content" => $_POST['content']
        ];
        try {
            foreach ($_POST['ws_server']->ports[1]->connections as $fd) {
                $_POST['ws_server']->push($fd, json_encode($data,true));
            }
        }
        catch(\Exception $e){
            return Util::show(1,$e->getMessage());
        }
        return Util::show(0,"ok",$data);
    }
}