<?php
namespace Math;

use InvalidArgumentException;

class NaturalNumber {

    public static function getRandomPrimeNumber() {
        $prime_index = rand(2, 30);
        for( $i = 2; ; $i++ ) {
            $prime_number = new static( $i );
            if ($prime_number->isPrime()) {
                if ( $prime_index === 0 ) return $prime_number;
                else $prime_index--;
            }
        }
    }


	private $n;

	public function __construct( $n ) {
		$this->n = $n;
		if ( !$this->isNaturalNumber() ) {
			throw new InvalidArgumentException("자연수 아닌데?");
		}
	}

    /**
     * @return bool
     */
    public function isNaturalNumber()
    {
        return is_integer( $this->n ) && $this->n > 0;
    }

    /**
     * @return bool
     */
    public function isPrime()
    {
        if ( $this->n === 1 ) {
            throw new \RuntimeException('1이 아닌 자연수를 입력해주세요.');
        }

        $sqrt = sqrt( $this->n );

        for ( $i = 2; $i <= $sqrt; $i++ ) {
            if ( $this->n % $i === 0 ) return false;
        }
        return true;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->n;
    }

    /**
     * @param NaturalNumber $other
     * @return static
     */
    public function multiply(NaturalNumber $other)
    {
        return new static( $this->n * $other->getNumber() );
    }

    public function phin(NaturalNumber $other) {
        return new static( ($this->n - 1) * ($other->getNumber()-1) );
    }

}