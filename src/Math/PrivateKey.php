<?php
namespace Math;

class PrivateKey
{
    private $n;
    private $d;

    public function __construct(NaturalNumber $n, NaturalNumber $d)
    {
        $this->n = $n;
        $this->d = $d;
    }

    public function getN()
    {
        return $this->n;
    }

    public function getD()
    {
        return $this->d;
    }
}