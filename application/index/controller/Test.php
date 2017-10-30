<?php

namespace app\index\controller;

use think\Controller;
use poker\Card, poker\Package;
use math\Point, math\Rectangle, math\Circle, math\Line;


class Test extends Controller
{
    public function index()
    {
       $package = new Package();
       $res = $package->deal();
       p($res);




    }

    public function getPI($time = 12345)
    {
        $pointsTotal = $pointsInCircle = 0;
        for ($i = 0; $i < $time; $i++) {
            $p = new Point(lcg_value(), lcg_value());
            $circle = new Circle(new Point(0, 0), 1);
            $in = Circle::inCircle($p, $circle);
            if ($in) {
                $pointsInCircle++;
            }
            $pointsTotal++;
        }
        echo (4*$pointsInCircle/$pointsTotal);

    }


}

