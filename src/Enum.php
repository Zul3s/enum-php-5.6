<?php

namespace Zul3s\EnumPhp;

use \JsonSerializable;
use Zul3s\EnumPhp\Interfaces\EnumInterface;

/**
 * Class Enum
 * Advanced Php Enum Type for PHP >= 5.6
 *
 * @package Zul3s\EnumPhp-5.6
 *
 * @author Julien Zirnheld <julienzirnheld@gmail.com>
 */
abstract class Enum implements EnumInterface, JsonSerializable
{
    /**
     * @var mixed $value
     */
    private $value;

    /**
     * @var string $key
     */
    private $key;

    /**
     * @var string $description
     */
    protected $description;

    /**
     * Enum constructor.
     * @param int|string    $value
     * @param string        $key
     */
    final private function __construct($value, $key)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @param $method
     * @param array $args
     * @return EnumInterface
     * @throws \UnexpectedValueException
     * @throws \ReflectionException
     */
    final public static function __callStatic($method, $args)
    {
        return self::byKey($method);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getValue();
    }

    /**
     * @throws \LogicException
     */
    final private function __clone()
    {
        throw new \LogicException('Enums are singleton, it is not cloneable');
    }

    /**
     * Return the enum value when json_encode() is called
     *
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->getValue();
    }

    /**
     * Return enum value
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return enum name
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get content of description annotation
     *
     * @return string
     * @throws \InvalidArgumentException
     * @throws \ReflectionException
     */
    public function getDescription()
    {
        if ($this->description === null) {
            EnumCacheManagement::setDescriptions(static::class);
        }
        if ($this->description === null) {
            throw new \InvalidArgumentException('No description is available for ' . static::class .
                ' with value : ' . $this->value);
        }
        return $this->description;
    }

    /**
     * Check if this instance of enum is equals to another
     *
     * @param EnumInterface $enum
     * @return bool
     */
    public function isEqual(EnumInterface $enum = null)
    {
        return $this === $enum;
    }

    /**
     * Return instance of called class enum with const name
     *
     * @param $key
     * @return EnumInterface
     * @throws \UnexpectedValueException
     * @throws \ReflectionException
     */
    public static function byKey($key)
    {
        return EnumCacheManagement::getInstanceByName(static::class, $key);
    }

    /**
     * This method can be used when you have just value of const in Enum class
     * and you want the Enum instance.
     * The optional strict parameter is used to be sure Enum class has an instance
     * with same value and same type of value
     *
     * @param $value
     * @param bool $strict compare the type to be sure
     * @return EnumInterface
     * @throws \UnexpectedValueException
     * @throws \ReflectionException
     */
    public static function byValue($value, $strict = true)
    {
        return EnumCacheManagement::getInstanceByValue(static::class, $value, $strict);
    }

    /**
     * Get all possible instance of called class Enum
     *
     * @return array [Enum {...}, Enum {...}, ...]
     * @throws \ReflectionException
     */
    public static function getAll()
    {
        return EnumCacheManagement::getAll(static::class);
    }

    /**
     * Get values of called class Enum
     *
     * @return array [key => value, key => value, ...]
     * @throws \ReflectionException
     */
    public static function getValues()
    {
        return EnumCacheManagement::getValues(static::class);
    }

    /**
     * Check if key is valid into the class
     *
     * @param $key
     * @return boolean
     * @throws \ReflectionException
     */
    public static function isValidKey($key)
    {
        return EnumCacheManagement::isValidKey(static::class, $key);
    }

    /**
     * Check if value is valid into the class
     * The optional strict parameter is used for strict compares
     *
     * @param mixed $value
     * @param bool $strict
     * @return boolean
     * @throws \ReflectionException
     */
    public static function isValidValue($value, $strict = true)
    {
        return EnumCacheManagement::isValidValue(static::class, $value, $strict);
    }
}
