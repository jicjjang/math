<?php

namespace Math;

use InvalidArgumentException;
use Exception;

class Number
{

    protected $natural_num, $prime, $prime_num1, $prime_num2;

    /**
     * @param int $num
     */
    protected function isNaturalNumber( $natural_num )
    {
        if (!is_integer( $natural_num ) ) {
            throw new InvalidArgumentException('숫자를 넣어주세요.');
        } else if ( $natural_num < 0 ) {
            throw new InvalidArgumentException('자연수가 아닙니다.');
        }
        $this->natural_num = $natural_num;
    }

    /**
     * @param int $num
     * @return bool
     * @throws Exception
     */
    protected function isPrime( $natural_num )
    {

        self::isNaturalNumber( $natural_num );

        if ( $natural_num === 0 || $natural_num === 1 ) {
            throw new InvalidArgumentException('1이 아닌 자연수를 입력해주세요.');
        }

        $sqrt = sqrt( $natural_num );

        for ( $inc = 2; $inc < $sqrt; $inc++ ) {
            $prime_num = $natural_num / $inc;
            $this->prime = ( is_integer( $prime_num ) ) ? true : false;

            if ( $this->prime ) {
                $this->prime_num1 = $prime_num;
                $this->prime_num2 = $inc;
                return false;
            } else if ( $sqrt - intval($sqrt) == 0 ) {
                $this->prime_num1 = $prime_num;
                $this->prime_num2 = $inc;
                return false;
            }
        }
        return true;
    }

    protected function isDisjoint( $num1, $num2 ) {
        while ( true ) {
            $quotient = $num1 / $num2;
            $remainder = $num1 % $num2;

            if ( $remainder === 0) {
                break;
            }
            $num1 = $num2;
            $num2 = $remainder;
        }

        if ( $num2 === 1 ) {
            return true;
        } else {    /* 최대공약수는 num2이다. */
            return false;
        }
    }
}
