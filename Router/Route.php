<?php

namespace OwlyCode\ThematicSpeech\Router;

class Route
{
    private $thematicNames;

    private $callable;

    public function __construct(array $thematicNames, callable $callable)
    {
        $this->thematicNames = $thematicNames;
        $this->callable      = $callable;
    }

    public function getCallable()
    {
        return $this->callable;
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
