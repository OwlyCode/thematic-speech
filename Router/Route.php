<?php

namespace OwlyCode\ThematicSpeech\Router;

class Route
{
    /**
     * @var string[]
     */
    private $thematicNames;

    /**
     * @var callable
     */
    private $callable;

    /**
     * @var ArgumentPattern[]
     */
    private $patterns;

    /**
     * @param string[]          $thematicNames
     * @param callable          $callable
     * @param ArgumentPattern[] $patterns
     */
    public function __construct(array $thematicNames, callable $callable, array $patterns = [])
    {
        $this->thematicNames = $thematicNames;
        $this->callable      = $callable;
        $this->patterns      = $patterns;
    }

    /**
     * @return callable
     */
    public function getCallable()
    {
        return $this->callable;
    }

    /**
     * @return ArgumentPattern[]
     */
    public function getArgumentPatterns()
    {
        return $this->patterns;
    }

    /**
     * @param string[] $thematics
     *
     * @return boolean
     */
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
