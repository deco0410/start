<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\User as UserModel;

class Blog extends Controller
{
    public function index(){
        $author = input('author');
        $check_author = UserModel::get(['nickname'=>$author]);

        if($check_author){
            $this->assign('author', $author);
            return view('blog/index');

        }else{
            return view('index/index');
        }

    }

    public function newBlog(){
        $author = input('author');
        $this->assign('author', $author);
        return view('blog/newBlog');

    }

    public function postBlog(){
        $data = input('post.');
        $title = $data['title'];
        $nickname = $data['nickname'];
        p($_REQUEST);

    }













}

