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
\think\Route::rule(':version/user/:id','api/:version.User/read');


return [
    '__pattern__' => [
        'name' => '\w+',
        'id' => '\d+'
    ],

    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'get']],
    ],

    'email/:qq' => 'index/index/email' ,


    //'register' => 'index/index/register',
    //'registerOk' => 'index/index/registerOk',



    '[user]'=>[
        'index' => 'index/user/index',
        'create' => 'index/user/create',
        'add' => 'index/user/add',
        'add_list' => 'index/user/addList',
        ':id' => 'index/user/read',
        'update/:id' => 'index/user/update',
        'delete/:id' => 'index/user/delete',
        'add_book/:id' => 'index/user/addBook',
        'book_list/:id' => 'index/user/bookList',
        'add_role' => 'index/user/addRole',
        'delete_role' => 'index/user/deleteRole',
    ],

    'fy' => 'fuiou/index/index',
    'order' => 'fuiou/index/index',
    'query' => 'fuiou/index/query',
    'refund' => 'fuiou/index/refund',

/*    '[fy]' => [

    ],*/

];
