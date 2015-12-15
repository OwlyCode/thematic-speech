<?php

namespace OwlyCode\ThematicSpeech;

use OwlyCode\ThematicSpeech\Parser\ArgumentMatcher;
use OwlyCode\ThematicSpeech\Parser\Thematic;
use OwlyCode\ThematicSpeech\Parser\ThematicMatcher;
use OwlyCode\ThematicSpeech\Parser\Tokenizer;
use OwlyCode\ThematicSpeech\Router\Route;
use OwlyCode\ThematicSpeech\Router\Router;

class ThematicSpeech
{
    /**
     * @var Thematic[]
     */
    private $thematics;

    /**
     * @var Router
     */
    private $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    /**
     * @param mixed $thematics
     *
     * @return ThematicSpeech
     */
    public function registerThematics(array $thematics)
    {
        $this->thematics = [];

        foreach ($thematics as $name => $value) {
            if ($value instanceof Thematic) {
                $this->thematics[] = $value;
            } else {
                $this->thematics[] = new Thematic($name, $value);
            }
        }

        return $this;
    }

    /**
     * @param array    $thematics
     * @param array    $patterns
     * @param callable $action
     *
     * @return ThematicSpeech
     */
    public function register(array $thematics, array $patterns, callable $action)
    {
        $this->router->register(new Route($thematics, $action, $patterns));

        return $this;
    }

    /**
     * @param string $string
     */
    public function process($string)
    {
        $matcher    = new ThematicMatcher($this->thematics);
        $argMatcher = new ArgumentMatcher();
        $tokenizer  = new Tokenizer();
        $sentence   = $tokenizer->buildSentence($string);
        if ($route  = $this->router->resolve($matcher->detect($sentence))) {
            $arguments = $argMatcher->getArguments($route->getArgumentPatterns(), $sentence);
            call_user_func($route->getCallable(), $arguments);
        }
    }
}
