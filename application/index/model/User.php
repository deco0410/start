<?php

namespace app\index\model;

use think\Model;


class User extends Model
{
    protected $name = 'user';
    protected $type = ['birthday' => 'timestamp:Y-m-d',];
    protected $autoWriteTimestamp = true;
    protected $insert = ['status' => 1];

    public function  profile()
    {
        return $this->hasOne('Profile');
    }

    public function  books()
    {
        return $this->hasMany('Book');
    }

    protected function setStatusAttr($value, $data){
        return 'deco' == $data['nickname']? 1 : 2;
    }

    protected function getStatusAttr($value){
        $status = [1 => 'admin', 2 => 'guest'];
        return $status[$value];
    }



    protected function scopeEmail($query)
    {
        $query->where('email', 'jacky@qq.com');
    }

    protected function scopeStatus($query)
    {
        $query->where('status', 1);
    }

   /* protected static function base($query)
    {
        $query->where('status', 1);
    }*/



}