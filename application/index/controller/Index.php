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
        $data = input('post.');
        //修改页面的请求
        if (array_key_exists('email', $data)) {
      //if(isset($data['email'])){       //两种方法
            //获取原昵称
            $origin_nickname = UserModel::get(['email' => $data['email']]);
            $origin_nickname = $origin_nickname['nickname'];
            //查找新昵称
            $check_nickname = UserModel::get(['nickname' => $data['nickname']]);
            //用户修改昵称时判断新昵称是否存在（不包括原昵称）
            if ($origin_nickname != $data['nickname'] && !$check_nickname) {
                return 'allow';

            } elseif ($origin_nickname == $data['nickname']) {
                return 'unchanged';

            } else {
                return 'deny';
            }
            //注册页面的请求
        } else {
            $check = UserModel::get(['nickname' => $data['nickname']]);

            if ($check) {
                return 'deny';
            } else {
                return 'allow';
            }
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

    public function getProfile()
    {

        $data = input('nickname');
        $user_info = UserModel::get(['nickname' => $data], 'profile');

        $this->assign('info', $user_info);
        return $this->fetch('profile');

    }

    public function editProfile()
    {
        $data = input('post.');
        $email = session('email');
        $origin_nickname = UserModel::get(['email' => $email])->value('nickname');
        $check_nickname = UserModel::get(['nickname' => $data['nickname']]);

        if (!$data['nickname']) {
            $this->error('昵称不能为空！');

        } elseif ($origin_nickname != $data['nickname'] && $check_nickname) {
            $this->error('昵称已经存在！');

        } else {
            if (!$data['mobile']) {
                $this->error('手机号不能为空！');

            } else {
                $pattern = '/^1[34578][0-9]{9}$/';
                preg_match($pattern, $data['mobile'], $match);

                if (!$match) {
                    $this->error('手机号格式不正确');

                } else {
                    $user = UserModel::get(['email' => $email]);
                    $update_user = $user->save(['nickname' => $data['nickname'], 'mobile' => $data['mobile']]);
                    $update_profile = $user->profile()->select() ?
                        $user->profile->save(['gender' => $data['gender'], 'birthday' => $data['birthday'], 'address' => $data['address']]) :
                        $user->profile()->save(['gender' => $data['gender'], 'birthday' => $data['birthday'], 'address' => $data['address']]);

                    if ($update_user || $update_profile) {
                        session('nickname', $user['nickname']);
                        $this->success('用户信息更新成功！', 'index');

                    } else {
                        $this->success('用户信息更新失败！');

                    }
                }
            }

        }

    }

    public function scroll()
    {
        return view();
    }


    /* public function save($name = '')
     {
         Session::set('user_name', $name);

         $this->success('Session设置成功!');

     }*/

}
