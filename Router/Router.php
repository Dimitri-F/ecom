<?php

namespace Router;

use Exceptions\RouteNotFoundException;

class Router
{
    private array $routes;

    public function register(string $path, array $action) : void
    {
        $this->routes[$path] = $action;
    }

    /**
     * @throws RouteNotFoundException
     */
    public function resolve(string $uri)
    {
        $path = explode('?', $uri)[0];
        $action = $this->routes[$path] ?? null;

        if(is_array($action)) {
            [$className, $method] = $action;

            if(class_exists($className) && method_exists($className, $method)){
                $class = new $className();
                return call_user_func_array([$class, $method], []);
            }
        }

        throw new RouteNotFoundException();
    }



}