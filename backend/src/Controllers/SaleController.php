<?php

namespace App\Controllers;

use App\Services\SaleService;


class SaleController
{
    private $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
        // header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
    }

    public function createSale()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['products']) || !is_array($input['products'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Products are required']);
            return;
        }

        $sale = $this->saleService->createSale($input['products']);
        // header('Content-Type: application/json');
        echo json_encode($sale);
    }
}
