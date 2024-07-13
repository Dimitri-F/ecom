<?php

namespace Controller;

use Class\Renderer;

class ArticleController
{
    public function index()
    {
        return Renderer::make('articles');
    }
}