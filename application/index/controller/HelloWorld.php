<?php
namespace app\index\controller;


class HelloWorld {
    public function index($year){

        return url('hello_world/index','year = '.$year,'php');
    }
}
