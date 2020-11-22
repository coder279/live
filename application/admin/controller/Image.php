<?php
namespace app\admin\controller;
use app\common\lib\Util;

class Image
{

    public function index() {
        $file = request()->file('file');
        $info = $file->move('../public/upload');
        if($info) {
            $data = [
                'image' =>"http://127.0.0.1:9501/upload/".$info->getSaveName(),
            ];
            return Util::show(0, 'OK', $data);
        }else {
            return Util::show(1, 'error');
        }
    }

}
