<?php

/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/21/2017
 * Time: 9:56 AM
 */
abstract class MyEnum
{
    final public function __construct($value)
    {
        $c = new ReflectionClass($this);
        if (!in_array($value, $c->getConstants())) {
            throw IllegalArgumentException();
        }
        $this->value = $value;
    }

    final public function __toString()
    {
        return $this->value;
    }
}