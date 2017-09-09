<?php

namespace app\index\model;

use think\Model;


class User extends Model
{
    protected $name = 'user';
    protected $autoWriteTimestamp = true;

    public function  profile()
    {
        return $this->hasOne('Profile', 'user_id');
    }

    public function  blog()
    {
        return $this->hasMany('Blog', 'author_id');
    }


}