<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use PHPMailer\PHPMailer\PHPMailer;


// 应用公共文件
function P($object)
{
    echo "<pre>";
    print_r($object);

}

function checkRegister()
{
    //id: 3-->admin, 2-->user, 1-->guest
    $id = $_REQUEST['id'];
    if ($id == 2) {

    }

}

function nvl($aStr)
{
    if ($aStr == null)
        return "";
    else
        return $aStr;
}

function email($qq)
{
    $tomail = $qq . '@qq.com';
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->CharSet = 'utf8';
    $mail->Host = 'smtp.qq.com';
    $mail->SMTPAuth = true;
    $mail->Username = '9111616@qq.com';
    $mail->Password = 'aexmxbvragmvbhhg';
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;

    $mail->setFrom('9111616@qq.com');
    $mail->addAddress($tomail, 'deco');
    $mail->addReplyTo('9111616@qq.com', 'deco');

    $mail->Subject = 'This is a test.';
    $mail->Body = 'Hello world!';

    if (!$mail->send()) {
        echo 'Error sending msg!  ' . $mail->ErrorInfo;
    } else {
        echo 'Sending ok!';
    }

}

function httpPost($url, $str)
{

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $str);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($str))
    );
    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
}

function rand_num($len = 6)
{
    $count = 1;
    $str = '';
    while ($count <= $len) {
        $str .= mt_rand(0, 9);
        $count++;
    }
    return $str;
}





//error_reporting(E_ERROR|E_WARNING|E_PARSE);

