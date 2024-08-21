<?php

namespace Controller;

use Class\Renderer;

class HomeController
{
    public function showHomePage(): Renderer
    {
        return Renderer::make('home');
    }
}