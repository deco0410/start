<?php

namespace app\index\controller;

use app\index\Model\Profile;
use app\index\model\User as UserModel;
use think\Controller, think\Db, think\Session;

class Index extends Controller
{
    public function register()
    {

        return $this->fetch();

    }

    public function registerOk()
    {
        //TODO 验证注册数据
        $data = input('post.');

        $result = $this->validate($data, 'Index');   //用validate文件夹下的Index验证器

        if ($result !== true) {
            return $result;
        } else {
            $user = new UserModel();

            $result1 = $user->allowField(['nickname', 'password', 'level'])->save($data);
            if ($result1) {
                $profile = new Profile();
                $result2 = $profile->allowField(['gender', 'birthday', 'mobile', 'email'])->save($data);
                if ($result2) {
                    $this->success('注册成功！', 'login');
                }else{
                    $this->error('注册失败', 'register');
                }

            }else{
                $this->error('注册失败', 'register');
            }


        }
        /*   $this->validate($data['code'],[
               'captcha|验证码' => 'require|captcha'
           ]) ;
          */
        //$this->success('注册成功！', 'login');
    }

    public function login()
    {

        return $this->fetch();

    }

    public function loginOk()
    {

        $this->success('登录成功', 'index');

    }

    public function hello()
    {
        echo 'hello';
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
