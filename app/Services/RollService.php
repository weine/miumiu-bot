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
        $msg = '【1~100】Miu擲出的點數為 : ' . $roll;

        return $msg;
    }
}
