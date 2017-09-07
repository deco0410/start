<?php
namespace app\index\model;

use think\Model;

class  comment extends Model
{
    protected function blog(){
        return $this->belongsTo('Blog');
    }
}