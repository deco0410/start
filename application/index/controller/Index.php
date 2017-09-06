<?php
namespace app\index\controller;

use think\Controller, think\Db, think\Session;
use PHPMailer\PHPMailer\PHPMailer ;
use PHPMailer\PHPMailer\Exception ;

class Index extends Controller
{
    public function email($qq){
        $tomail = $qq.'@qq.com';
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

        if(!$mail->send()){
            echo 'Error sending msg!  '.$mail->ErrorInfo;
        }else{
            echo 'Sending ok!';
        }

    }


    public function hello()
    {
       $select = Db::name('user')->page(1, 7)->select();
    }

    public function index()
    {
        return $this->fetch();
    }

    public function save($name = '')
    {
        Session::set('user_name', $name);

        $this->success('Session设置成功!');

    }

}
