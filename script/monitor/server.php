<?php
//监控服务 ws http
class Server{
    const PORT = 9501;

    public function port(){
        $shell = 'netstat -anp 2>/dev/null |grep '.self::PORT . '|grep LISTEN | wc -l';
        $flag = shell_exec($shell);
        if($flag != 1){
            echo "服务挂掉了".PHP_EOL;
        }else{
            echo "服务正常运行中".PHP_EOL;
        }
    }
}
swoole_timer_after(2000,function($timer_id){
    
});
