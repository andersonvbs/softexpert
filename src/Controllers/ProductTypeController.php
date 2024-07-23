<?php

namespace App\Controllers;

use App\Services\ProductTypeService;


class ProductTypeController
{
    private $productTypeService;

    public function __construct(ProductTypeService $productTypeService)
    {
        $this->productTypeService = $productTypeService;
    }

    public function getProductTypes()
    {
        $products = $this->productTypeService->getProductTypes();
        header('Content-Type: application/json');
        echo json_encode($products);
    }

    public function createProductType()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['name'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Product type name is required']);
            return;
        }

        $product = $this->productTypeService->createProductType($input['name']);
        header('Content-Type: application/json');
        echo json_encode($product);
    }

    public function deleteProductType($vars)
    {
        $id = (int)$vars['id'];
        
        $deleted = $this->productTypeService->deleteProductType($id);
        
        if ($deleted) {
            http_response_code(204);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Product type not found']);
        }
    }
}
