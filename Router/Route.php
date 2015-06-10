<?php

namespace OwlyCode\ThematicSpeech\Router;

class Route
{
    private $thematicNames;

    private $callable;

    private $patterns;

    public function __construct(array $thematicNames, callable $callable, array $patterns = array())
    {
        $this->thematicNames = $thematicNames;
        $this->callable      = $callable;
        $this->patterns      = $patterns;
    }

    public function getCallable()
    {
        return $this->callable;
    }

    public function getArgumentPatterns()
    {
        return $this->patterns;
    }

    public function matches(array $thematics)
    {
        foreach ($this->thematicNames as $thematic) {
            if (!in_array($thematic, $thematics)) {
                return false;
            }
        }

        return true;
    }
}
