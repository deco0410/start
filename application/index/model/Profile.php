<?php

namespace app\index\Model;

use think\Model;

class Profile extends Model
{
    protected $name = 'profile';
    protected $type = ['birthday' => 'timestamp:Y-m-d', ];

    public function user()
    {
        return $this->belongsTo('User');
    }

   /* protected function getBirthdayAttr($birthday)
    {
        return date('Y-m-d', $birthday);
    }

    protected function setBirthdayAttr($birthday)
    {
        return strtotime($birthday);
    }*/



}