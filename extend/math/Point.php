<?php
namespace math;

class Point
{
    protected $x, $y;

    public function __construct($x, $y)
    {
        $this->x = $x;  $this->y = $y;
    }

    public static function distance(Point $p1, Point $p2)
    {
        $x1 = $p1->x;   $y1 = $p1->y;
        $x2 = $p2->x;   $y2 = $p2->y;
        $distance = sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));

        return $distance;
    }


}