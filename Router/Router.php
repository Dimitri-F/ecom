<?php

namespace Router;

use Exceptions\RouteNotFoundException;

class Router
{
    private array $routes;

    public function register(string $path, callable|array $action) : void
    {
        $this->routes[$path] = $action;
    }
    
    /**
     * @throws RouteNotFoundException
     */
    public function resolve(string $uri)
    {
        $path = explode('?', $uri)[0];

        foreach ($this->routes as $route => $action) {
            // Remplace les paramètres dynamiques dans la route par des expressions régulières
            $pattern = preg_replace('#\{[a-zA-Z0-9_]+\}#', '([a-zA-Z0-9_]+)', $route);

            // Vérifie si le chemin correspond au modèle
            if (preg_match('#^' . $pattern . '$#', $path, $matches)) {
                array_shift($matches); // Retire le premier élément qui est l'URL entière

                if (is_callable($action)){
                    return $action();
                }

                if (is_array($action)) {
                    [$className, $method] = $action;

                    if (class_exists($className) && method_exists($className, $method)) {
                        $class = new $className();

                        // Appelle la méthode avec les arguments extraits
                        return call_user_func_array([$class, $method], $matches);
                    }
                }
            }
        }

        throw new RouteNotFoundException();
    }

}