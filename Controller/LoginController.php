<?php

namespace Controller;

use Class\Renderer;

class LoginController
{
        public function login(): Renderer
    {
        return Renderer::make('login');
    }

    public function registration(): Renderer
    {
        return Renderer::make('registration');
    }

    public function logout(): Renderer
    {
        return Renderer::make('logout');
    }

}