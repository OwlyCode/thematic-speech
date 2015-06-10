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
    private $thematics;

    private $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function registerThematics(array $thematics)
    {
        $this->thematics = array();

        foreach ($thematics as $name => $value) {
            if ($value instanceof Thematic) {
                $this->thematics[] = $value;
            } else {
                $this->thematics[] = new Thematic($name, $value);
            }
        }
    }

    public function register(array $thematics, array $patterns, callable $action)
    {
        $this->router->register(new Route($thematics, $action, $patterns));
    }

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
