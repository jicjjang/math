<?php
namespace Math;

use PHPUnit_Framework_TestCase;
use Wandu\Route\Validator;

class NaturalNumberTest extends PHPUnit_Framework_TestCase
{

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructException() {
        new NaturalNumber(-1);
    }

    public function testIsPrime() {

        $this->assertEquals(
            (new NaturalNumber(30))->isPrime(),
            false
        );

        $this->assertEquals(
            (new NaturalNumber(15))->isPrime(),
            false
        );

        $this->assertEquals(
            (new NaturalNumber(10))->isPrime(),
            false
        );

        $this->assertEquals(
            (new NaturalNumber(5))->isPrime(),
            true
        );

        $this->assertEquals(
            (new NaturalNumber(3))->isPrime(),
            true
        );

        $this->assertEquals(
            (new NaturalNumber(111))->isPrime(),
            false
        );

        $this->assertEquals(
            (new NaturalNumber(117))->isPrime(),
            false
        );

        $this->assertEquals(
            (new NaturalNumber(9))->isPrime(),
            false
        );

    }
}