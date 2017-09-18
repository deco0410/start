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

/*    protected function setGenderAttr($value, $data){
        switch ($data['gender'])
        {
            case 'male': return 1;
            break;
            case 'female': return 2;
            break;
            case 'unknown': return 0;
            break;

        }
    }*/

   /* protected function getGenderAttr($value){
        $status = [1 => 'male', 2 => 'female', 0 => 'unknown'];
        return $status[$value];
    }*/

   /* protected function getBirthdayAttr($birthday)
    {
        return date('Y-m-d', $birthday);
    }

    protected function setBirthdayAttr($birthday)
    {
        return strtotime($birthday);
    }*/



}