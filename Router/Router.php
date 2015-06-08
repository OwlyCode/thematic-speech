<?php

namespace OwlyCode\ThematicSpeech\Router;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = array();
    }

    public function register(Route $route)
    {
        $this->routes[] = $route;
    }

    public function resolve(array $thematics)
    {
        foreach ($this->routes as $route) {
            if ($route->matches($thematics)) {
                return $route;
            }
        }

        return null;
    }
}
