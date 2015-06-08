<?php

namespace OwlyCode\ThematicSpeech;

use OwlyCode\ThematicSpeech\Parser\Matcher;
use OwlyCode\ThematicSpeech\Parser\Thematic;
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

    public function register(array $thematics, callable $action)
    {
        $this->router->register(new Route($thematics, $action));
    }

    public function process($string)
    {
        $matcher   = new Matcher($this->thematics);
        $tokenizer = new Tokenizer();

        if ($route = $this->router->resolve($matcher->detect($tokenizer->buildSentence($string)))) {
            call_user_func($route->getCallable());
        }
    }
}
