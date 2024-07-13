<?php

namespace Controller;

use Class\Renderer;

class ClientController
{
    public function index()
    {
        return Renderer::make('clients');
    }
}