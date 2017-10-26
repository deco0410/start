<?php

namespace app\index\controller;

use think\Controller;
use math\Point, math\Rectangle, math\Circle;


class Test extends Controller
{
    public function index()
    {

    }

    public function calculatePI($time = 9999)
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
        echo $pointsInCircle.'<br/>'.$pointsTotal.'<br/>';
        echo (4*$pointsInCircle/$pointsTotal);

    }


}

