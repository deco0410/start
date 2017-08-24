<?php
namespace app\index\Model;

use think\Model;

class Role extends  Model{
    protected $name = 'role';

    public function user()
    {
        return $this->belongsToMany('User', 'access');
    }
}