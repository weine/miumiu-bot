<?php
/**
 * Created by PhpStorm.
 * User: 馬爺
 * Date: 2018/10/6
 * Time: 下午 02:20
 */

namespace App\Services;


class RollService
{
    protected $min = 1;
    protected $max = 100;

    public function numberRandom()
    {
        $roll = rand($this->min, $this->max);
        $msg = 'Miu擲出的點數(1~100) : ' . $roll;

        return $msg;
    }
}
