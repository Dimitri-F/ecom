<?php

namespace Controller;

use Class\Renderer;
use Model\ProductModel;

class ProductController
{
    public function index(): Renderer
    {
        $productModel = new ProductModel();
        $products = $productModel->getAll();

        return Renderer::make('products', ['products' => $products]);
    }

    public function detail($id): Renderer
    {
        $productModel = new ProductModel();
        $product = $productModel->getByID($id);

        return Renderer::make('products_detail', ['product' => $product]);
    }


}