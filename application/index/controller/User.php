<?php

namespace app\index\controller;

use app\index\model\User as UserModel;

class User
{
    public function add()
    {
        //$user = new UserModel();
        $user['nickname'] = 'jacky';
        $user['email'] = 'jacky@qq.com';
        $user['birthday'] = '2007-02-10';
        $user['create_time'] = time();
        if ($result = UserModel::create($user)) {
            return '用户[' . $result->nickname . ':' . $result->id . ']' . '于' . date('Y-m-d H:i:s', time()) . ' 添加成功';

        } else {
            return 'error';
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
            return 'multiple users has been successfully added!';
        } else {
            return 'error adding multiple users!';
        }
    }

    public function read($id = '')
    {
        $user = UserModel::get($id);
        echo $user->nickname . "<br/>";
        echo $user->email . "<br/>";
        echo $user->birthday . "<br/>";
        echo $user->status . "<br/>";
    }

    public function index()
    {
        $list = UserModel::scope('email')->select();
        foreach ($list as $user) {
            echo $user->nickname . '<br/>';
            echo $user->email . '<br/>';
            echo $user->birthday . '<br/>';
            echo $user->status . '<br/>';
            echo '-------------------------------------<br/>';
        }
    }

    /* public function index()
     {
         $users = UserModel::scope('email')
             ->scope('status')->scope(function ($query){
                 $query->order('id', 'desc');
             });
         foreach ($users as $user) {
             echo $user->nickname . "<br/>";
             echo $user->email . "<br/>";
             echo $user->birthday . "<br/>";
             echo $user->status . "<br/>";
             echo "---------------------------------------<br/>";
         }
     }*/

    public function update($id)
    {
        // $user = UserModel::get($id);
        $data = ['id' => (int)$id, 'nickname' => 'Tang', 'email' => 'TYN@qq.com'];
        if (UserModel::update($data)) {
            return 'update ok!';
        } else {
            return 'update error!';
        }
    }

    public function delete($id)
    {
        $user = UserModel::get($id);
        if ($user) {
            $user->delete();
            return 'delete successfully!';
        } else {
            return 'failed to delete!';
        }
    }


}