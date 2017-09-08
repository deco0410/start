<?php
namespace app\index\model;

use think\Model;

class  comment extends Model
{
    protected $autoWriteTimestamp = true;
    protected function blog(){
        return $this->belongsTo('Blog');
    }
}