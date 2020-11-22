<?php
namespace app\common\lib\ali;


require_once APP_PATH . '/../extend/ali/vendor/SignatureHelper.php';



/**
 * Class SmsDemo
 *
 * Created on 17/10/17.
 * 短信服务API产品的DEMO程序,工程中包含了一个SmsDemo类，直接通过
 * 执行此文件即可体验语音服务产品API功能(只需要将AK替换成开通了云通信-短信服务产品功能的AK即可)
 * 备注:Demo工程编码采用UTF-8
 */
class Sms
{


    /**
     * 发送短信
     * @param $phone
     * @param $code
     * @return mixed|\SimpleXMLElement
     */
    public static function sendSms($phone, $code) {

        $params = array ();

        //阿里云的AccessKey
        $accessKeyId = '';

        //阿里云的Access Key Secret
        $accessKeySecret = '';

        //要发送的手机号
        $params["PhoneNumbers"] = $phone;

        //签名，第三步申请得到
        $params["SignName"] = '';

        //模板code，第三步申请得到
        $params["TemplateCode"] = '';

        //模板的参数，注意code这个键需要和模板的占位符一致
        $params['TemplateParam'] = Array (
            "code" => $code
        );

        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper();
        try{
            // 此处可能会抛出异常，注意catch
            $content = $helper->request(
                $accessKeyId,
                $accessKeySecret,
                "dysmsapi.aliyuncs.com",
                array_merge($params, array(
                    "RegionId" => "cn-hangzhou",
                    "Action" => "SendSms",
                    "Version" => "2017-05-25",
                ))
            // fixme 选填: 启用https
            // ,true
            );
            $res=array('errCode'=>0,'msg'=>'ok');
            if($content->Message!='OK'){
                $res['errCode']=1;
                $res['msg']=$content->Message;
            }
            echo json_encode($res);
        }catch(\Exception $e){
            echo '短信接口请求错误';exit;
        }

    }
    

}