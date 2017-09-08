<?php

namespace app\index\model;

use think\Model;


class User extends Model
{
    protected $name = 'user';
    protected $autoWriteTimestamp = true;

    public function  profile()
    {
        return $this->hasOne('Profile');
    }

    public function  blog()
    {
        return $this->hasMany('Blog', 'author_id');
    }


    protected function getLevelAttr($value)
    {
        $status = [ 1 => 'guest', 2 => 'user', 3 => 'admin' ];
        return $status[$value];
    }


    protected function scopeLevel($query)
    {
        $query->where('level', '1');
    }


}