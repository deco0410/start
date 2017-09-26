<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\User as UserModel;
use think\Db;

class Blog extends Controller
{
    public function index(){
        $author = input('author');
        $check_author = UserModel::get(['nickname'=>$author]);

        if($check_author){
            $this->assign('author', $author);
            return $this->fetch('blog/index');

        }else{
            return $this->fetch('index/index');
        }
    }











}

