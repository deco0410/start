<?php
namespace app\index\model;

use think\Model;

class Blog extends Model
{

    protected function user(){
        return $this->belongsTo('User');
    }

    protected function comments(){
        return $this->hasMany('Comment');
    }
}