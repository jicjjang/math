<?php
namespace Math;

use Exception;

class RSA
{

    final public static function encrypt( $m, PublicKey $key ) {
        return self::powMod( $m, $key->getE()->getNumber(), $key->getN()->getNumber() );
    }

    final public static function decrypt( $c, PrivateKey $key ) {
        return self::powMod( $c, $key->getD()->getNumber(), $key->getN()->getNumber() );
    }

    final public static function powMod( $n, $pow, $mod ) {
        if ( $pow == 1 ) {
            return $n % $mod;
        }
        return ( $n % $mod * self::powMod( $n, $pow-1, $mod ) ) % $mod;
    }

    public static function generate() {
        do {
            $p = NaturalNumber::getRandomPrimeNumber();
            $q = NaturalNumber::getRandomPrimeNumber();
        } while( $p->getNumber() === $q->getNumber() );
        return new static( $p, $q );
    }


    /** @var NaturalNumber  */
    private $p;

    /** @var NaturalNumber  */
    private $q;

    private $privateKey;

    private $publicKey;

    /**
     * @param NaturalNumber $p
     * @param NaturalNumber $q
     */
    public function __construct(NaturalNumber $p, NaturalNumber $q)
    {
        if (!$p->isPrime()) {
            throw new \InvalidArgumentException("p가.. 소수가 아니네여?");
        }
        if (!$q->isPrime()) {
            throw new \InvalidArgumentException('q가 소수가 아니네여..');
        }

        $this->p = $p;
        $this->q = $q;
    }


    public function getPublicKey()
    {
        if (!isset($this->publicKey)) {
            $this->generateKey();
        }
        return $this->publicKey;
    }

    public function getPrivateKey()
    {
        if (!isset($this->privateKey)) {
            $this->generateKey();
        }
        return $this->privateKey;
    }

    public function generateKey() {
        $n = $this->p->multiply($this->q);
        $phin = $this->p->phin($this->q);
        $e = $this->getRandomArray($this->getDisjointNumbers($phin));

        for( $d = 1; ; $d++) {
            if ( $d == $e->getNumber() ) continue;
            if ( ( $d * $e->getNumber() ) % $phin->getNumber() === 1 ) {
                break;
            }
        }

        $this->publicKey = new PublicKey( $n, $e );
        $this->privateKey = new PrivateKey( $n, new NaturalNumber($d) );
    }

    /**
     * @param NaturalNumber $x
     * @return array<NaturalNumber>
     */
    public function getDisjointNumbers(NaturalNumber $x ) {
        $numbers = [];
        for( $i = 2; $i < $x->getNumber(); $i++ ) {
            if ( $this->isDisjoint($x->getNumber(),$i) ) {
                $numbers[] = new NaturalNumber($i);
            }
        }
        return $numbers;
    }

    /**
     * @param int $a
     * @param int $b
     * @return bool
     */
    public function isDisjoint( $a, $b ) {
        if ( $this->gcd($a, $b) === 1 ) return true;
        return false;
    }

    /**
     * @param int $p
     * @param int $q
     * @return int
     */
    public function gcd($p, $q) {
        if ( $q == 0 ) return $p;
        return $this->gcd( $q, $p % $q );
    }

    /**
     * @param array<NaturalNumber> $array
     * @return NaturalNumber
     */
    public function getRandomArray( array $array ) {
        return $array[ rand(0, count($array)-1) ];
    }

}

