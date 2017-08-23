<?php
namespace app\index\Validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        ['nickname', 'min:5|token', '昵称不能小于5个字符！'],
        ['email', 'email', '邮箱格式不正确！'],
        ['birthday', 'dateFormat:Y-m-d', '日期格式不正确！'],
    ];

}