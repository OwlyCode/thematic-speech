<?php

namespace OwlyCode\ThematicSpeech\Parser;

class ArgumentPattern
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $pattern;

    /**
     * @param string $type
     * @param string $pattern
     */
    public function __construct($type, $pattern)
    {
        $this->type    = $type;
        $this->pattern = $pattern;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $string
     *
     * @return Argument[]
     */
    public function getMatchedArguments($string)
    {
        preg_match_all($this->pattern, $string, $matches);

        $matches = array_key_exists(1, $matches) ? $matches[1] : [];

        return array_map(function ($match) {
            return new Argument($this->type, $match);
        }, $matches);
    }
}
