<?php

namespace OwlyCode\ThematicSpeech\Router;

class Router
{
    /**
     * @var Route[]
     */
    private $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    /**
     * @param Route $route
     *
     * @return Router
     */
    public function register(Route $route)
    {
        $this->routes[] = $route;

        return $this;
    }

    /**
     * @param string[] $thematics
     *
     * @return Route|null
     */
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
