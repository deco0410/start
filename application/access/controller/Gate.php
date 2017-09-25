<?php
namespace app\gym\Controller;

use think\Controller;


class gateControl extends Controller
{
    public function index(){

        return $this->fetch();
    }

    public function addModule()
    {
        header("Content-type: text/html; charset=utf-8");

        define('APPID', 'wmj_Vsf536qRMP2');
        define('APPSECRET', '6xjC923a4EK0v0f50JahJFsSwKdKLdIx');
        define('AESKEY', ''); //AES加密密钥，不用就留空

        //$aes = new Aes();

        $lock_sn = 'WMJ18866364'; //锁的序列号，这个序列号贴在每个模块的标签上。
        //$lock_sn = $aes->encrypt($lock_sn, AESKEY);  //传递数据经过AES加密，如果需要的话就用。

        /*
         *DEMO -- 第一步：提交模块到系统注册
         */
        $result = httpPost('https://www.wmj.com.cn/api/postlock.html?appid='.APPID.'&appsecret='.APPSECRET, $lock_sn);
        /*
         *DEMO -- 第二步：查询模块在线状态
         */
        //$result = httpPost('https://www.wmj.com.cn/api/lockstate.html?appid='.APPID.'&appsecret='.APPSECRET, $lock_sn);
        /*
         *DEMO -- 第三步：开门
         */
        //$result = httpPost('https://www.wmj.com.cn/api/openlock.html?appid=' . APPID . '&appsecret=' . APPSECRET, $lock_sn);
        /*
         *DEMO -- 删除锁接口，在不需要这个模块时可以通过这个接口删除。
         */
        //$result = httpPost('https://www.wmj.com.cn/api/dellock.html?appid='.APPID.'&appsecret='.APPSECRET, $lock_sn);
        $result = trim($result, "\xEF\xBB\xBF"); //去除BOM头
        print_r(json_decode($result, true));
    }

}


// Aes加密解密方法类
class Aes
{
    function encrypt($value, $key)
    {
        $padSize = 16 - (strlen($value) % 16);
        $value = $value . str_repeat(chr($padSize), $padSize);
        $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $value, MCRYPT_MODE_CBC, str_repeat(chr(0), 16));

        return base64_encode($output);
    }

    function decrypt($value, $key)
    {
        $value = base64_decode($value);
        $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $value, MCRYPT_MODE_CBC, str_repeat(chr(0), 16));

        $valueLen = strlen($output);

        if ($valueLen % 16 > 0) $output = "";

        $padSize = ord($output - 1);

        if (($padSize < 1) or ($padSize > 16)) $output = "";

        for ($i = 0; $i < $padSize; $i++) {
            if (ord($output - 1) != $padSize) $output = "";
        }
        $output = substr($output, 0, $valueLen - $padSize);

        return $output;
    }
}

