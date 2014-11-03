<?php

namespace Math;

use InvalidArgumentException;

class Numbaer {

    public $num, $prime;

    /**
     * @param int $num
     */
    public function isNaturalNumber( $num = 0 ) {
        if (!is_integer($num)) {
            throw new InvalidArgumentException('자연수가 아닙니다.');
        } else if ($num < 0) {
            throw new InvalidArgumentException('자연수가 아닙니다.');
        } else if ($num === 0 || $num === 1) {
            throw new InvalidArgumentException('1이 아닌 자연수를 입력해주세요.');
        }
        $this->num = $num;
    }

    /**
     * @param int $num
     * @return bool
     */
    public function isPrime( $num = 0 ) {

        isNaturalNumber( $num );

        $sqrt = sqrt($this->num);

        for ( $inc = 2; $inc < $sqrt; $inc++ ) {
            $prime_num = $this->num / $inc;
            $this->prime = ( is_integer( $prime_num ) ) ? true : false;

            if ( $this->prime || is_integer( $sqrt ) ) {
                return false;
            }
        }
        return true;
    }
}