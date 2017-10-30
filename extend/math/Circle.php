<?php
namespace math;

use math\Point;

class Circle
{
    protected $center, $radius;

    public function __construct(Point $center, $radius)
    {
        $this->center = $center;
        $this->radius = $radius;

    }

    /**check if a point is in a circle
     * @param \math\Point $p
     * @param Circle $circle
     * @return bool
     */
    public static function inCircle(Point $p, Circle $circle)
    {
        $center = $circle->center;
        $radius = $circle->radius;
        $distance = Point::distance($p, $center);

        return $distance < $radius;

    }

    public function getArea()
    {
        $radius = $this->radius;
        $area   = M_PI * $radius * $radius;

        return $area;

    }

     public function getCircumference()
    {
        $radius = $this->radius;
        $circumference   = 2 * M_PI * $radius;

        return $circumference;

    }


}