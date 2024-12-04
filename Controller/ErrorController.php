<?php

namespace Controller;

use Src\Renderer;

class ErrorController
{
    public function pageNotFound()
    {
        return Renderer::make('404');
    }
}