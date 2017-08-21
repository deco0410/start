<?php
namespace app\index\controller;

use app\index\model\User as UserModel;

class User{
    public function add()
    {
        //$user = new UserModel();
        $user['nickname'] = 'deco';
        $user['email'] = '9111616@qq.com';
        $user['birthday'] = strtotime('1982-04-10');
        $user['create_time'] = time();
        if (UserModel::create($user)) {
            return '用户[' . $user->nickname  . ':' . $user->id . ']'.'于'.date('Y-m-d H:i:s',time()).' 添加成功';

        } else {
            return 'error';
        }
    }
}