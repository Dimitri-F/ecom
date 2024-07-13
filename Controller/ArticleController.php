<?php

namespace Controller;

use Class\Renderer;

class ArticleController
{
    public function index(): Renderer
    {
        return Renderer::make('articles');
    }
}