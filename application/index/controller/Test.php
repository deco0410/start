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
        $A = new Hand(new Card('K', 'spade'),
            new Card('K', 'spade'),
            new Card('5', 'heart'),
            new Card('T', 'spade'),
            new Card('T', 'spade'));
        $B= new Hand(new Card('K', 'spade'),
            new Card('K', 'spade'),
            new Card('3', 'diamond'),
            new Card('T', 'spade'),
            new Card('T', 'spade'));
        echo Hand::compare($A, $B);



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

