<?php

namespace Zul3s\EnumPhp\Interfaces;

/**
 * Class Enum
 * Advanced Php Enum Type
 *
 * @package Zul3s\EnumPhp
 *
 * @author Julien Zirnheld <julienzirnheld@gmail.com>
 */
interface EnumInterface
{
    /**
     * Return enum value
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Return enum name
     *
     * @return string
     */
    public function getKey();

    /**
     * Check if this instance of enum is equals to another
     *
     * @param EnumInterface $enum
     * @return bool
     */
    public function isEqual(EnumInterface $enum = null);

    /**
     * Return instance of called class enum with const name
     *
     * @param $key
     * @return EnumInterface
     */
    public static function byKey($key);

    /**
     * This method can be used when you have just value of const in Enum class
     * and you want the Enum instance.
     * The optional strict parameter is used to be sure Enum class has an instance
     * with same value and same type of value
     *
     * @param $value
     * @param bool $strict compare the type to be sure
     * @return EnumInterface
     */
    public static function byValue($value, $strict = true);

    /**
     * Get all possible instance of called class Enum
     *
     * @return array [EnumInterface {...}, EnumInterface {...}, ...]
     */
    public static function getAll();

    /**
     * Get values of called class Enum
     *
     * @return array [key => value, key => value, ...]
     */
    public static function getValues();

    /**
     * Check if key is valid into the class
     *
     * @param $key
     * @return boolean
     */
    public static function isValidKey($key);

    /**
     * Check if value is valid into the class
     * The optional strict parameter is used for strict compares
     *
     * @param mixed $value
     * @param bool $strict
     * @return boolean
     */
    public static function isValidValue($value, $strict = true);
}
