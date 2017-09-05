<?php

namespace app\api\controller\v1;

use app\api\model\User as UserModel;
use think\Session;

class User
{
    public function read($id = 0)
    {
        \session(
            ['prefix' => 'module',
                'type' => '',
                'auto_start' => 'true',

            ]);

        // 赋值（当前作用域）
        session('name', 'thinkphp');
        // 赋值think作用域
        session('name', 'thinkphp', 'think');
        // 判断（当前作用域） 是否赋值
        session('?name');
        // 取值（当前作用域）
        session('name');
        // 取值think作用域
        session('name', '', 'think');

        session('name', null);
        // 清除session（当前作用域）
        session(null);
        // 清除think作用域
        session(null, 'think');


        exit;
        try {
            $user = UserModel::get($id);
            if ($user) {
                return json($user);
            } else {
                //return json(['error'=>'user dosen\'t exist.'], 404);
                abort(404, 'use doesn\'t exist.');
                exit;
            }
        } catch (\Exception $e) {
            return abort(404, $e->getMessage());
        }

    }

}