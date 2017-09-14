<?php

namespace app\index\controller;

use app\index\Model\Profile;
use app\index\model\User as UserModel;
use think\Controller, think\Db, think\Session, think\Request;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();

    }

    //在注册界面检查用户名是否存在
    public function checkEmail()
    {
        $data = input('post.')['email'];
        //$data = Request::instance()->post('email');
        $check = UserModel::get(['email' => $data]);
        if ($check) {
            return 'deny';
        } else {
            return 'allow';
        }

    }

    public function checkNickname()
    {
        $data = input('post.')['nickname'];
        $check = UserModel::get(['nickname' => $data]);
        if ($check) {
            return 'deny';
        } else {
            return 'allow';
        }

    }


    public function register()
    {
        return $this->fetch();

    }

    public function registerOk()
    {
        $data = input('post.');
        $validate = $this->validate($data, 'Index');   //用validate文件夹下与控制器同名(此处为Index)的验证器

        if ($validate == true) {

            if ($this->checkEmail() == 'allow') {

                if ($this->checkNickname() == 'allow') {
                    $user = new UserModel();
                    $user->email = $data['email'];
                    $user->password = md5($data['password']);
                    $user->nickname = $data['nickname'];
                    $user->mobile = $data['mobile'];

                    if ($user->save()) {
                        $this->success('注册成功！', 'login');

                    } else {
                        $this->error('注册失败', 'register');
                    }
                } else {
                    $this->error('该昵称已经存在!', 'register');
                }
            } else {
                $this->error('该邮箱名已经注册!', 'register');
            }
        } else {
            return $validate;
        }

    }


    public function login()
    {
        return $this->fetch();

    }

    public function loginOk()
    {
        $data = input('post.');
        $check = UserModel::get(['email' => $data['email']]);

        if ($check) {
            if ($check['password'] == md5($data['password'])) {
                session('email', $check['email']);
                session('nickname', $check['nickname']);

                $this->success('登录成功!', 'index');

            } else {
                session('email', $check['email']);
                $this->error('密码错误,请重新输入密码!', 'login');
            }

        } else {
            $this->error('该邮箱名不存在,请重新登录!', 'login');
        }

    }


    public function logout()
    {

        session(null);
        return $this->fetch('index');
    }

    public function getProfile(){
        $data = input('nickname');
        p($data);exit;
    }


    /* public function save($name = '')
     {
         Session::set('user_name', $name);

         $this->success('Session设置成功!');

     }*/

}
