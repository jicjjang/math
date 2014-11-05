<?php
namespace Math;

class PublicKey
{

    private $n;
    private $e;

    public function __construct(NaturalNumber $n, NaturalNumber $e)
    {
        $this->n = $n;
        $this->e = $e;
    }

    public function getN()
    {
        return $this->n;
    }

    public function getE()
    {
        return $this->e;
    }
}