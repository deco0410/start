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
        $A = new Hand(new Card('A', 'spade'),
            new Card('K', 'heart'),
            new Card('J', 'spade'),
            new Card('T', 'spade'),
            new Card('Q', 'spade'));
        $B = new Hand(new Card('A', 'diamond'),
            new Card('K', 'diamond'),
            new Card('J', 'diamond'),
            new Card('T', 'diamond'),
            new Card('Q', 'diamond'));

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

    /**get number of the last monkey
     * @param int $count count number in each round
     * @param int $sum total number of monkeys
     * @return int $king number of the King
     */
    public function King(int $count = 3, int $sum = 5)
    {
        $list = range(1, $sum);
        while (count($list) > 1) {
            $length = count($list);
            $position = $count % $length == 0 ? $length - 1 : $count % $length - 1;
            if ($position > 0) {
                $move = [];
                for ($i = 0; $i < $position; $i++) {
                    array_push($move, $list[$i]);
                }
                $list = array_slice($list, $position + 1);
                $list = array_merge($list, $move);
            } else {
                array_shift($list);
            }
        }
        return $king = $list[0];
    }

    protected function G($n = 1)
    {
        if ($n == 0) {
            return 0;
        } else {
            return $n - $this->G($this->G($n - 1));
        }
    }

}

