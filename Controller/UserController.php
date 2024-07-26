<?php

namespace Controller;

use Class\Renderer;
use Model\UserModel;

class UserController
{
    public function index(): Renderer
    {
        return Renderer::make('users');
    }
}