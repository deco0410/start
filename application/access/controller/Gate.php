<?php

namespace app\access\Controller;

use think\Controller;


class Gate extends Controller
{
    public function index()
    {

        return $this->fetch();

    }

    public function wmj()
    {

        $action = input('action');
        $appid = input('appid');
        $appsecret = input('appsecret');
        $lock_sn = input('lock_sn');
        $aeskey = input('aeskey');
        $aes = new Aes();
        $lock_sn = $aes->encrypt($lock_sn, $aeskey);  //传递数据经过AES加密，如果需要的话就用。

        if ($action == '注册模块') {
            $result = httpPost('https://www.wmj.com.cn/api/postlock.html?appid=' . $appid . '&appsecret=' . $appsecret, $lock_sn);
            $result = trim($result, "\xEF\xBB\xBF"); //去除BOM头
            $result = json_decode($result, true);
            $state = $result['state'] == 1 ? '模块添加成功' : '模块添加失败';
            $msg = $result['state_msg'];
            $this->assign('post_state', $state);
            $this->assign('post_msg', $msg);
            return $this->fetch('gate/index');

        }

        if ($action == '检查模块') {
            $result = httpPost('https://www.wmj.com.cn/api/lockstate.html?appid=' . $appid . '&appsecret=' . $appsecret, $lock_sn);
            $result = trim($result, "\xEF\xBB\xBF"); //去除BOM头
            $result = json_decode($result, true);
            $state = $result['state'] == 1 ? '模块在线' : '模块不在线';
            $msg = $result['state_msg'];
            $this->assign('check_state', $state);
            $this->assign('check_msg', $msg);
            return $this->fetch('gate/index');

        }

        if ($action == '开门') {
            $result = httpPost('https://www.wmj.com.cn/api/openlock.html?appid=' . $appid . '&appsecret=' . $appsecret, $lock_sn);
            $result = trim($result, "\xEF\xBB\xBF"); //去除BOM头
            $result = json_decode($result, true);
            $state = $result['state'] == 1 ? '开门成功' : '开门失败';
            $msg = $result['state_msg'];
            $this->assign('opem_state', $state);
            $this->assign('open_msg', $msg);
            return $this->fetch('gate/index');

        }

        if ($action == '注销模块') {
            $result = httpPost('https://www.wmj.com.cn/api/dellock.html?appid=' . $appid . '&appsecret=' . $appsecret, $lock_sn);
            $result = trim($result, "\xEF\xBB\xBF"); //去除BOM头
            $result = json_decode($result, true);
            $state = $result['state'] == 1 ? '模块删除成功' : '模块删除失败';
            $msg = $result['state_msg'];
            $this->assign('delete_state', $state);
            $this->assign('delete_msg', $msg);
            return $this->fetch('gate/index');

        }

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

