<?php

namespace Controller;

use Class\Renderer;

class UserController
{
    public function index(): Renderer
    {
        return Renderer::make('users');
    }
}