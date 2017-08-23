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

    public function addBook()
    {
        $user = User::get(1);
        $book = new Book;
        $book->title = 'Game of Thrones';
        $book->publish_time = '2010-01-01';
        $user->books()->save($book);
        return 'add book ok!';
    }

}