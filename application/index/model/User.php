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


    protected function getLevelAttr($value){
        $status = [ 0 => 'admin', 1 => 'guest', 2 => 'user' ];
        return $status[$value];
    }


    protected function scopeLevel($query)
    {
        $query->where('level', '0');
    }






}