<?php

namespace app\algorithm\controller;

use think\Controller;

class Sort extends Controller
{
    public function test()
    {
        $arr = [3, 5, 4, 3, 89, 25, 3, 2, 1, 67, 98, 4, 1];
        $this->bubble($arr);
    }

    protected function bubble(array $arr)
    {
        $t1 = microtime();
        $length = count($arr);
        for ($i = $length - 1; $i > 0; $i--) {
            for ($j = 0; $j < $i; $j++) {
                if ($arr[$j] > $arr[$j + 1]) {
                    swap($arr[$j], $arr[$j + 1]);
                }
            }
        }
        $t2 = microtime();
        echo $t2 - $t1;
        p($arr);
    }

    protected function straight_insert(array $arr)
    {
        $des = [];
        $t1 = microtime();
        for ($i = 0; $i < count($arr); $i++) {
            if (empty($des)) {
                array_push($des, $arr[$i]);
            } else {
                $flag = 0;
                for ($j = 0; $j < count($des); $j++) {
                    if ($arr[$i] <= $des[$j]) {
                        array_splice($des, $j, 0, $arr[$i]);
                        $flag = 1;
                        break;
                    } else {
                        continue;
                    }
                }
                if ($flag == 0) {
                    array_push($des, $arr[$i]);
                }
            }
        }
        $t2 = microtime();
        echo $t2 - $t1;
        p($des);
    }





}

function swap(&$a, &$b)
{
    if ($a > $b) {
        $tmp = $a;
        $a = $b;
        $b = $tmp;
    }
}