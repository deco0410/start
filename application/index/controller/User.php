<?php

namespace app\index\controller;

use app\index\model\User as UserModel;
use app\index\model\Profile;
use think\Controller;


class User extends Controller
{
    public function add()
    {
        $user = new UserModel;
        $user->name = 'deco';
        $user->password = '111111';
        $user->nickname = 'deco';

        if ($user->save()){
            $profile = new Profile;
            $profile->truename = 'TangYi';
            $profile->birthday = '1982-04-10';
            $profile->address = 'Changsha';
            $profile->email = '9111616@qq.com';
            $user->profile()->save($profile);
            return 'new user with profile has been added !';
        }else{
            return $user->getError();
        }

    }

    public function addList()
    {
        $user = new UserModel();

        $lst = [
            ['nickname' => 'deco', 'email' => 'deco@qq.com', 'birthday' => strtotime('1982/08/08')],
            ['nickname' => 'eva', 'email' => 'eva@qq.com', 'birthday' => strtotime('1984/08/08')],
            ['nickname' => 'edward', 'email' => 'edward@qq.com', 'birthday' => strtotime('2012/03/30')],
        ];

        if ($user->saveAll($lst)) {
            return 'multiple users has been successfully added !';
        } else {
            return 'error adding multiple users !';
        }
    }

    public function read($id = '')
    {
        $user = UserModel::get($id, 'profile');
        echo $user->name . "<br/>";
        echo $user->nickname . "<br/>";
        echo $user->password . "<br/>";
        echo $user->status . "<br/>";
        echo $user->profile->truename . "<br/>";
        echo $user->profile->birthday . "<br/>";
        echo $user->profile->address . "<br/>";
        echo $user->profile->email . "<br/>";
        echo $user->create_time . "<br/>";
    }

    public function index()
    {
        $list = UserModel::all();
        foreach ($list as $user) {
            echo $user->nickname . '<br/>';
           // echo $user->email . '<br/>';
           // echo $user->birthday . '<br/>';
            echo $user->status . '<br/>';
            echo '-------------------------------------<br/>';
        }
    }

    public function update($id)
    {
        $user = UserModel::get($id);
        $user->name = 'jacky';
       // $data = ['id' => (int)$id, 'nickname' => 'Tang', 'email' => 'TYN@qq.com'];
        if ($user->save()) {

            $user->profile->email = 'liu21st@gmail.com';
            $user->profile->save();

            return '用户[ ' . $user->name . ' ]更新成功';
        } else {
            return $user->getError();
        }
    }

    public function delete($id)
    {
        $user = UserModel::get($id);
        if ($user) {
            $user->delete();
            $user->profile->delete();
            return '用户[ ' . $user->name . ' ]删除成功';
        } else {
            return $user->getError();
        }
    }

    public function create()
    {
        return view('user/create');
    }


}