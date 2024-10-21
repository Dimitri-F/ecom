<?php

namespace Controller;

use Src\Renderer;

class HomeController
{
    public function showHomePage(): Renderer
    {
        return Renderer::make('home');
    }

    public function showAboutPage(): Renderer
    {
        return Renderer::make('about');
    }
}