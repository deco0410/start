<?php

namespace app\index\Validate;

use think\Validate;

class Index extends Validate
{
    protected $rule = [
        ['email', 'require|email', '邮箱不能为空!|邮箱格式不正确!'],
        ['password', 'require|min:8', '密码不能为空!|密码必须大于8个字符!'],
        ['nickname', 'require', '昵称不能为空!'],
        ['mobile', 'require|/^[1][34578][0-9]{9}/', '手机号码不能为空!|手机号码格式不正确'],

    ];
}
