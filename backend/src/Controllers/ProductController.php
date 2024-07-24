<?php

namespace App\Controllers;

use App\Services\ProductService;


class ProductController
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        // header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
    }

    public function getProducts()
    {
        $products = $this->productService->getProducts();
        echo json_encode($products);
    }

    public function createProduct()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['name'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Product name is required']);
            return;
        }

        if (!isset($input['product_type_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Product type is required']);
            return;
        }

        if (!isset($input['price'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Product price is required']);
            return;
        }

        $product = $this->productService->createProduct($input['name'], $input['product_type_id'], $input['price']);
        // header('Content-Type: application/json');
        echo json_encode($product);
    }

    public function deleteProduct($vars)
    {
        $id = (int)$vars['id'];
        
        $deleted = $this->productService->deleteProduct($id);
        
        if ($deleted) {
            http_response_code(204);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Product not found']);
        }
    }
}
