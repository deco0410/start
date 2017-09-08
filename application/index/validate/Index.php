<?php
namespace app\index\Validate;

use think\Validate;

class Index extends Validate
{
    protected $rule = [
      ['nickname'  , 'require|min:5', '昵称不能为空!|昵称必须大于5个字符!'],
      ['password'  , 'require|min:8', '密码不能为空!|密码必须大于8个字符!'],
      ['birthday'  , 'dateFormat:Y-m-d', '日期格式不正确!'],
      ['mobile'  , '/^[1][34578][0-9]{9}/', '手机号码格式不正确'],
      ['email'  , 'email', '邮箱格式不正确!'],
    ];
}
