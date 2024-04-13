<?php
//singleton


class Single
{
    private static $elem = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
        throw new ErrorException('singleton cannot be serialized');
    }

    public static function getSingle()
    {
        if (!isset(self::$elem)){
            self::$elem = new static();
        }
        return self::$elem;
    }
}

$obj = Single::getSingle();
$obj2 = Single::getSingle();

var_dump($obj === $obj2);

