<?php

namespace Math;

use Exception;

class RSA extends Euler {

    protected $plaintext, $cryptogram;

    public function encryption ( $plaintext, $prime_num1, $prime_num2 )
    {
        if (!is_integer($plaintext)) {
            throw new Exception('숫자 평문을 입력해주세요.');
        }

        Euler::eulerDefine_key($prime_num1, $prime_num2);

        $this->plaintext = $plaintext;

        $temp = $this->plaintext;
        for ($i = 0; $i < $this->value_e; $i++) {
            $temp *= $this->plaintext;
            if ($temp > $this->value_n) {
                $temp %= $this->value_n;
            }
            print_r("{$temp}\n");
        }
        $this->cryptogram = $temp;

        if ($this->cryptogram === 1 || $this->plaintext === 1) {
            throw new Exception('평문이나 암호문이 1이면 안됩니다.');
        }

        if ($this->cryptogram == 1 || $this->cryptogram == 0 || $this->plaintext == 1 || $this->plaintext == 0) {
            throw new Exception('평문이나 암호문이 0 또는 1이면 안됩니다.');
        }

        print_r("<<-- ENCRYPTION -->>\n");
        var_dump($this->plaintext);
        print_r("\n");
        var_dump($this->value_n, $this->value_e, $this->value_d);
        print_r("\n");
        var_dump($this->cryptogram);
    }

    public function decryption ( $cryptogram, $value_n, $value_d )
    {
        if (!is_integer($cryptogram)) {
            throw new Exception('숫자 암호문을 입력해주세요.');
        }

        Euler::eulerPhi($value_n, null);

        $this->value_n = $value_n;
        $this->value_d = $value_d;

        $this->cryptogram = $cryptogram;

        $temp = $this->cryptogram;
        for ($i = 0; $i < $this->value_d; $i++) {
            $temp *= $this->cryptogram;
            if ($temp > $this->value_n) {
                $temp %= $this->value_n;
            }
            print_r("{$temp}\n");
        }
        $this->plaintext = $temp;

        if ($this->cryptogram == 1 || $this->cryptogram == 0 || $this->plaintext == 1 || $this->plaintext == 0) {
            throw new Exception('평문이나 암호문이 0 또는 1이면 안됩니다.');
        }

        print_r("<<-- DECRYPTION -->>\n");
        var_dump($this->cryptogram);
        print_r("\n");
        var_dump($this->value_n, $this->value_e, $this->value_d);
        print_r("\n");
        var_dump($this->plaintext);
    }
}

