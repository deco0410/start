<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
/*use think\Route;

Route::rule('hello_world/index/:name', function ($name){
            return 'hi'.$name ;
        });*/
return [
    '__pattern__' => [
        'name' => '\w+',
        'id' => '\d+',
        'year' => '\d{4}',
        'month' => '\d{2}',
    ],

    '[hello]'   => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
        ':year' => ['hello_world/index', ['method' => 'get'],['year' => '\d{4}']],
    ],

   '[hello_world]' => [
       ':year' => ['hello_world/index', ['method' => 'get'],['year' => '\d{4}']]
    ],

    ];
