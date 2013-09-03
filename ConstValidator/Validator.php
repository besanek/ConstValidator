<?php

namespace ConstValidator;

/**
 * Validates constants
 *
 * @author Robert Jelen <robert.jelen@email.cz>
 */
class Validator
{
    /** @var string[] Cached set of acceptable values */
    protected $results = array();

    /** @var self Singleton instance */
    private static $instance;

    /**
     * Returns singleton instance
     *
     * @return self
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static;
        }

        return self::$instance;
    }

    /**
     * Validates constants value
     *
     * @param string $name  Name or expression of expected constants
     * @param mixed  $value Actual constant
     *
     * @return bool
     */
    public static function validate($name, $value)
    {
        $validator = self::getInstance();

        if (!isset($validator->results[$name])) {
            $validator->fetchValues($name);
        }

        return $validator->isValid($name, $value);
    }

    /**
     * Is valid value
     *
     * @param string $name  Name in cache
     * @param mixed  $value
     *
     * @return bool
     */
    protected function isValid($name, $value)
    {
        return in_array($value, $this->results[$name], true);
    }

    /**
     * Fetch values for map of constants
     *
     * @param string $map
     */
    protected function fetchValues($map)
    {
        $pattern = new Pattern($map);
        $reflection = new \ReflectionClass($pattern->getClass());
        $constants = $reflection->getConstants();

        $values = array();
        $expression = $pattern->getExpression();
        foreach ($constants as $name => $constant) {
            if ($this->checkName($expression, $name)) {
                   $values[] = $constant;
            }
        }
        $this->results[$map] = $values;
    }

    /**
     * Return if constant name belongs to expression
     *
     * @param string $expression
     * @param string $name
     *
     * @return bool
     */
    protected function checkName($expression, $name)
    {
        return preg_match($expression, $name);
    }
}
