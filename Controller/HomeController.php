<?php

namespace Controller;

use Class\Renderer;

class HomeController
{
    public function index()
    {
        return Renderer::make('accueil');
    }
}