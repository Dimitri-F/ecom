<?php

namespace Src;

use Exceptions\RouteNotFoundException;
use Router\Router;

class App
{
    private Router $router;
    private string $requestUri;

    public function __construct(Router $router, string $requestUri)
    {
        $this->requestUri = $requestUri;
        $this->router = $router;
    }

    public function run(): void
    {
        try {
            echo $this->router->resolve($this->requestUri);
        } catch (RouteNotFoundException $e) {
            echo $e->getMessage();
        }
    }
}