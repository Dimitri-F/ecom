<?php

namespace Controller;

use Class\Renderer;

class ClientController
{
    public function index(): Renderer
    {
        return Renderer::make('clients');
    }
}