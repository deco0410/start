<?php

namespace app\index\controller;

use poker\Card;
use poker\Hand;
use think\Controller;
use math\Point, math\Rectangle, math\Circle, math\Line;


class Test extends Controller
{
    public function index()
    {
        $hand = new Hand(new Card('A', 'spade'),
            new Card('K', 'spade'),
            new Card('2', 'diamond'),
            new Card('T', 'spade'),
            new Card('Q', 'spade'));
        p($hand->power);


    }

    /**calculating Pi using Monte Carlo method
     * @param int $time the number of points
     */
    protected function getPi($time = 12345)
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
        echo(4 * $pointsInCircle / $pointsTotal);
    }


}

