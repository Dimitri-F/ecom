<?php

namespace Controller;

use Class\Renderer;

class HomeController
{
    public function index(): Renderer
    {
        return Renderer::make('home');
    }
}