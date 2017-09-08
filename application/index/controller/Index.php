<?php
namespace app\index\controller;

use think\Controller, think\Db, think\Session ;

class Index extends Controller
{
    public function register(){

        return $this->fetch();

    }

    public function registerOk(){
        //TODO 验证注册数据
        $data = input();

     /*   $this->validate($data['code'],[
            'captcha|验证码' => 'require|captcha'
        ]) ;
       */
        $this->success('注册成功！', 'login');
    }

    public function login(){

        return $this->fetch();

    }

    public function loginOk(){

        $this->success('登录成功', 'index');

    }

    public function hello()
    {   echo 'hello';
      // $select = Db::name('user')->page(1, 7)->select();
    }

    public function index()
    {
        return $this->fetch();
    }

   /* public function save($name = '')
    {
        Session::set('user_name', $name);

        $this->success('Session设置成功!');

    }*/

}
