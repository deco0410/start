<?php

namespace app\index\controller;

use think\Controller, think\Db, think\Session;

class Index extends Controller
{
    public function hello()
    {
        $param = ['name' => 'deco', 'status' => 1];
        /*Db::name('data')
            ->where('id', '>=',2)
            ->insert($param);*/


        /*$list = Db::name('user')
                  ->chunk('1',function ($list){
                      foreach ($list as $item) {
                          P($item['name']);
                      }
                  });*/
        $list1 = Db::name('user')
            ->where(['id' => '60'])
            ->select();

        P($list1);
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
