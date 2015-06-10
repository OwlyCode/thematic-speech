<?php

namespace OwlyCode\ThematicSpeech\Parser;

class ArgumentPattern
{
    private $type;

    private $pattern;

    public function __construct($type, $pattern)
    {
        $this->type    = $type;
        $this->pattern = $pattern;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getMatchedArguments($string)
    {
        preg_match_all($this->pattern, $string, $matches);

        return $matches[1];
    }
}
