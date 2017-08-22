<?php
namespace app\index\model;

use think\Model;

class User1 extends Model
{
     // 查询条件为 name = 'thinkphp' ,且只查询 id 和 name两个字段
    protected function scopeThinkphp($query)
    {
        $query->where('name','thinkphp')->field('id,name');
    }

    // 查询条件为 score > 80
    protected function scopeAge($query)
    {
        $query->where('score','>',80);
    }

}