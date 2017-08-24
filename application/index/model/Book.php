<?php
namespace app\index\Model;

use think\Model;

class Book extends Model
{
    protected $name = 'book';
    protected $type = [
        'publish_time' => 'timestamp:Y-m-d',
    ];
    protected $autoWriteTimestamp = true;
    protected $insert = ['status' => 1];

    public function user()
    {
        return $this->belongsTo('User');
    }



}