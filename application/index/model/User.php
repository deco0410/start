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


    protected function setLevelAttr($value, $data){
        if (in_array($data['nickname'], ['deco', 'eva'])){
            return 'admin' ;
        }
    }


    protected function scopeEmail($query)
    {
        $query->where('email', 'jacky@qq.com');
    }




    /*protected static function base($query)
    {
        $query->where('status', 1);
    }*/



}