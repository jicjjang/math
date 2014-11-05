<?php

namespace Math;

use InvalidArgumentException;
use Exception;

class Euler extends Number {

    protected $value_n, $value_e, $value_d;
    protected $euler_phi;

    public function eulerPhi($prime_num1, $prime_num2=null)
    {
        if ($prime_num1 === $prime_num2) {
            throw new InvalidArgumentException('서로 다른 두 소수를 입력하세요.');
        }
        if (is_null($prime_num2)) {
            if (Number::isPrime($prime_num1)) {
                $this->euler_phi = $prime_num1 - 1;
                return;
            } else {
                $this->euler_phi = ($this->prime_num1 - 1) * ($this->prime_num2 - 1);
                return;
            }
        }
        else if (Number::isPrime($prime_num1) && Number::isPrime($prime_num2)) {
            $this->value_n = $prime_num1 * $prime_num2;
            if (Number::isPrime($this->value_n)) {
                $this->euler_phi = ($prime_num1 * $prime_num2) - 1;
                return;
            } else {
                $this->euler_phi = ($prime_num1 - 1) * ($prime_num2 - 1);
                return;
            }
        }
        else {
            throw new Exception('소수를입력하세요.');
        }
    }

    public function eulerDefine_key($prime_num1, $prime_num2)
    {
        self::eulerPhi($prime_num1, $prime_num2);

        $temp = [];

        for ($i = 2; $i < $this->value_n; $i++) {
            if (Number::isDisjoint($i, $this->euler_phi)) {
                array_push($temp, $i);
            }
        }
        if (count($temp) == 1) {
            $this->value_e = $temp[0];
        }
        else if(count($temp) > 1) {
            $temp_rand = array_rand($temp, 1);
            $this->value_e = array_splice($temp, $temp_rand, 1);
            $this->value_e = $this->value_e[0];
        }


        for ($j = 2; $j < 999999; $j++ ) {
            if (($j * $this->value_e) > $this->euler_phi) {
                if ((($j * $this->value_e) % $this->euler_phi) == 1) {
                    $this->value_d = $j;
                    return;
                }
            }
            if ($j == 999998) {
                $j = 2;
                if (count($temp) == 0) {
                    throw new Exception('키 값이 없습니다.');
                }
                $temp_rand = array_rand($temp, 1);
                $this->value_e = array_splice($temp, $temp_rand, 1);
                $this->value_e = $this->value_e[0];

            }
        }
    }
}