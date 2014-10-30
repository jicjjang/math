<?php

namespace Math;

use InvalidArgumentException;

class MyNumber {

    public $num, $prime;

    /**
     * @param int $num
     */
    public function __construct( $num = 0 ) {

        if ( !is_integer( $num ) ) {
            throw new InvalidArgumentException('정수를 입력해주세요.');
        }
        else if ( $num < 0 ) {
            throw new InvalidArgumentException('양수를 입력해주세요.');
        }
        else if ( $num === 0 || $num === 1 ) {
            throw new InvalidArgumentException('1이 아닌 자연수를 입력해주세요.');
        }
        $this->num = $num;

    }

    public function isPrime() {

        for ( $inc=2; $inc < $this->num; $inc++ ) {
            $prime_num = $this->num / $inc;
            $this->prime = ( is_integer( $prime_num ) ) ? true : false;
            if ( $this->prime ) {
                print_r('not prime');
                return;
            }
        }

        print_r('prime');
        return;
    }
}
