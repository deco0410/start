<?php
namespace app\index\controller;

use think\Controller;

class Blog extends Controller
{
    public function index($author){
        $this->assign('author', $author);
        $this->fetch('blog/index');
    }

}