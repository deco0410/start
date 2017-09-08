<?php
namespace app\index\model;

use think\Model;

class Blog extends Model
{
    protected $autoWriteTimestamp = true;

    protected function user(){
        return $this->belongsTo('User');
    }

    protected function comments(){
        return $this->hasMany('Comment');
    }

}

