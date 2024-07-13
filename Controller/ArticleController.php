<?php

namespace Controller;

use Class\Renderer;
use Model\ArticleModel;

class ArticleController
{
    public function index(): Renderer
    {
        $articleModel = new ArticleModel();
        $articles = $articleModel->getAll();

        return Renderer::make('articles', ['articles' => $articles]);
    }
}