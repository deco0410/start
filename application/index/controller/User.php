<?php

namespace app\index\controller;

use app\index\model\User as UserModel;
use app\index\model\Profile;
use think\Controller;

//checkreg();
class User extends Controller
{
    public function add()
    {








        exit;
        $user = new UserModel;
        $user->nickname = 'deco';
        $user->password = '111111';
        $user->level = 0;

        if ($user->save()) {
            $profile = new Profile;
            $profile->truename = 'TangYi';
            $profile->gender = 1;
            $profile->mobile = '13755179971';
            $profile->birthday = '1982-04-10';
            $profile->address = 'Changsha';
            $profile->email = 'glorysd@qq.com';
            $user->profile()->save($profile);
            return 'new user has been added !';
        } else {
            return $user->getError();
        }

    }

    public function addList()
    {
        $user = new UserModel();

        $lst = [
            ['nickname' => 'deco', 'email' => 'deco@qq.com', 'birthday' => strtotime('1982/08/08')],
            ['nickname' => 'eva', 'email' => 'eva@qq.com', 'birthday' => strtotime('1984/08/08')],
            ['nickname' => 'edward', 'email' => 'edward@qq.com', 'birthday' => strtotime('2012/03/30')],
        ];

        if ($user->saveAll($lst)) {
            return 'multiple users has been successfully added !';
        } else {
            return 'error adding multiple users !';
        }
    }

    public function read($id = '')
    {
        $user = UserModel::get($id, 'profile');
        P($user->toArray());EXIT;
        //trace($user);
        $this->assign('user', $user);
        $this->view->replace(['__PUBLIC__' => '/static',]);
        return $this->fetch();
        //P($user->append(['user_status'])->toArray());
        /*echo $user->name . "<br/>";
        echo $user->nickname . "<br/>";
        echo $user->password . "<br/>";
        echo $user->status . "<br/>";
        echo $user->profile->truename . "<br/>";
        echo $user->profile->birthday . "<br/>";
        echo $user->profile->address . "<br/>";
        echo $user->profile->email . "<br/>";
        echo $user->role;*/
    }

    public function index()
    {
        $info = new Profile;
        $list = $info->all();
        //$list = Profile::all();
        //p($list);exit;
        $this->assign('list', $list);
        $this->assign('count', count($list));
        //$this->view->engine->layout('layout/newLayout', '[__REPLACE__]');
        //$this->view->engine->layout(false);
        return $this->fetch();
        /*foreach ($list as $user) {
            echo $user->nickname . '<br/>';
            // echo $user->email . '<br/>';
            // echo $user->birthday . '<br/>';
            echo $user->status . '<br/>';
            echo '-------------------------------------<br/>';
        }*/
    }

    public function update($id)
    {
        $user = UserModel::get($id);
        $user->books()->where('title', 'The kite runner')->update(['title' => 'Crazy stone']);
        return 'update ok !';

        //$user->name = 'jacky';
        //$data = ['id' => (int)$id, 'nickname' => 'Tang', 'email' => 'TYN@qq.com'];
        /*if ($user->save()) {

            $user->profile->email = 'liu21st@gmail.com';
            $user->profile->save();

            return '用户[ ' . $user->name . ' ]更新成功';
        } else {
            return $user->getError();
        }*/
    }

    public function delete($id)
    {
        $user = UserModel::get($id);
        if ($user->delete()) {
            $user->profile->delete();
            $user->books()->delete();
            return '用户[ ' . $user->name . ' ]删除成功';

        } else {
            return $user->getError();
        }
    }

    public function create()
    {
        return view('user/create');
    }

    public function addBook($id)
    {
        $user = UserModel::get($id);
        /*$book = new Book;
        $book-> title = 'Game of Thrones';
        $book-> publish_time = '2010-01-01';
        $user-> books()-> save($book);*/
        $books = [
            ['title' => 'Harry Potter', 'publish_time' => '2017-08-20'],
            ['title' => 'The kite runner', 'publish_time' => '2015-08-20'],
        ];
        $user->books()->saveAll($books);
        return 'complete adding book!';
    }

    public function bookList($id)
    {
        $user = UserModel::get($id);
        //$info = $user->books()->where('user_id', 42)->select();
        $info = $user->books()->getByTitle('Harry Potter');

        dump($info);

    }

    public function addRole()
    {
        $user = UserModel::getByNickname('GaoKeJi');
        $result = $user->role()->save((['name' => 'editor', 'title' => '编辑']));
        if ($result) return 'update role ok !' ;

    }

    public function deleteRole()
    {
        $user = UserModel::get(53);
        $result = $user->role()->detach(2);
        if ($result) return 'detach role ok !';

    }


}