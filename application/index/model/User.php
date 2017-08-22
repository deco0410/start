<?php

namespace app\index\model;

use think\Model;


class User extends Model
{
    protected $name = 'user';
    protected $dateFormat = 'Y/m/d';
    protected $type = ['birthday' => 'timestamp:Y-m-d',];
    protected $autoWriteTimestamp = false;
    protected $insert = ['status'];

    protected function setStatusAttr($value, $data){
        return 'deco' == $data['nickname']? 1 : 2;
    }

    protected function getStatusAttr($value){
        $status = [1 => 'admin', 2 => 'guest'];
        return $status[$value];
    }

    protected function getBirthdayAttr($day)
    {
        return $day;
    }

    protected function setBirthdayAttr($birthday)
    {
        return strtotime($birthday);
    }

    protected function getUserBirthdayAttr($birthday, $data)
    {
        return date('Y-m-d', $data['birthday']);
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