<?php
namespace app\admin\controller;

use app\common\lib\Util;
use app\common\lib\redis\Predis;

class Live{

    public function push()
    {
        echo 12345;
        if(empty($_GET)){
            return Util::show(1,"尚未填写数据");
        }
        $clients = Predis::getInstance()->smembers('live_game_key');
        $teams = [
            1 => [
                'name' => '马刺',
                'logo' => '/live/imgs/team1.png',
            ],
            4 => [
                'name' => '火箭',
                'logo' => '/live/imgs/team2.png',
            ],
        ];

        $data = [
            'type' => intval($_GET['type']),
            'time' => date('H:i',time()),
            'title' => !empty($teams[$_GET['team_id']]['name']) ?$teams[$_GET['team_id']]['name'] : '直播员',
            'logo' => !empty($teams[$_GET['team_id']]['logo']) ?$teams[$_GET['team_id']]['logo'] : '',
            'content' => !empty($_GET['content']) ? $_GET['content'] : '',
            'image' => !empty($_GET['image']) ? $_GET['image'] : '',
        ];
        $taskData = [
            'method' => 'pushLive',
            'data' => $data
        ];
        $_POST['ws_server']->task($taskData);
        return Util::show(0,"发送成功");
    }

}