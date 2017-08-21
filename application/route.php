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

return [
    '__pattern__' => [
        'name' => '\w+',
        'id' => '\d+'
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'get']],
    ],
    '[user]'=>[
        'index' => 'index/user/index',
        'create' => 'index/user/create',
        'add' => 'index/user/add',
        'add_list' => 'index/user/add_list',
        'update/:id' => 'index/user/update',
        'delete/:id' => 'index/user/delete',
        ':id' => 'index/user/read',

    ]

];
