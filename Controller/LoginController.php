<?php

namespace Controller;

use Class\Renderer;

class LoginController
{
    public function index(): Renderer
    {
        return Renderer::make('login');
    }

    public function connexion(): Renderer
    {
        return Renderer::make('login');
    }


}