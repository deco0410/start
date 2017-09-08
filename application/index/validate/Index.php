<?php
namespace app\index\Validate;

use think\Validate;

class Index extends Validate
{
    protected $rule = [
      ['nickname'  , 'require|min:5', '昵称不能为空!|昵称必须大于5个字符!'],
      ['nickname'  , 'require|min:5', '昵称不能为空!|昵称必须大于5个字符!'],
      ['nickname'  , 'require|min:5', '昵称不能为空!|昵称必须大于5个字符!'],
    ];
}
