<?php

namespace ConstValidator;

/**
 * Manages pattern processing
 *
 * @author Robert Jelen <robert.jelen@email.cz>
 */
class Pattern
{
    /** @var string Class name */
    private $class;

    /** @var pattern Pattern of constants names */
    private $pattern;

    /**
     * @param string $map Expression to create pattern
     */
    public function __construct($map)
    {
        $this->parse($map);
    }

    /**
     * @return string Class name
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return string Expression of valid constants
     */
    public function getExpression()
    {
        return $this->createExpression($this->pattern);
    }

    /**
     * Parses the map
     *
     * @param string $map
     */
    private function parse($map)
    {
        list($className, $pattern) = explode("::", $map);
        $this->class = $className;
        $this->pattern = $pattern;
    }

    /**
     * Creates expression from pattern
     *
     * @param string $pattern
     *
     * @return string
     */
    private function createExpression($pattern)
    {
        return '~'.str_replace('*', '.*', $pattern).'~';
    }
}
