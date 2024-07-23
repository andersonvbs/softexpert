<?php

namespace App\Controllers;

use App\Services\ProductService;


class ProductController
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getProducts()
    {
        $products = $this->productService->getProducts();
        header('Content-Type: application/json');
        echo json_encode($products);
    }
}
