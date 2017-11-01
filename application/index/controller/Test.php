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
        $a = new Hand(new Card('K', 'spade'),
            new Card('A', 'spade'),
            new Card('Q', 'spade'),
            new Card('4', 'spade'),
            new Card('5', 'spade'));
        $b = new Hand(new Card('T', 'spade'),
            new Card('9', 'spade'),
            new Card('8', 'diamond'),
            new Card('6', 'spade'),
            new Card('7', 'spade'));
        p($a->power);
        p($b->power);
        echo Hand::compare($a, $b);
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

