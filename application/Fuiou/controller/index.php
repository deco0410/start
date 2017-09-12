<?php
namespace app\fuiou\Controller;

use think\Controller;


class Index extends Controller
{
    public function index(){

        return $this->fetch();

    }

    public function order(){

        return $this->fetch();

    }

     public function orderSend(){

        return $this->fetch();

    }


     public function orderResult(){

        return $this->fetch();

    }


    public function query(){

        return $this->fetch();

    }

    public function querySend(){


        return $this->fetch();

    }

    public function refund(){


        return $this->fetch();

    }

    public function refundSend(){


        return $this->fetch();

    }


}