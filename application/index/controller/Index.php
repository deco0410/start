<?php

namespace app\index\controller;

use think\Controller, think\Db;

class Index
{
    public function hello()
    {
        $param = ['name' => 'deco', 'status' => 1];
        /*Db::name('data')
            ->where('id', '>=',2)
            ->insert($param);*/


        $list = Db::name('data')
                  ->chunk('1',function ($list){
                      foreach ($list as $item) {
                          P($item['name']);
                      }
                  });


        P($list);
    }

}
