<?php

namespace App\Services;

use App\Repositories\SaleRepository;
Use App\Domain\Entities\Sale;
Use App\Domain\Entities\SaleProduct;


class SaleService
{
    private $saleRepository;

    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function createSale($products): Sale
    {
        $totalValue = 0;
        $totalTax = 0;
        $saleProducts = [];

        foreach ($products as $product) {
            $productValue = $product['value'];
            $quantity = $product['quantity'];
            $taxPercentage = $product['tax_percentage'];
            $taxValue = $productValue * ($taxPercentage / 100);

            $totalValue += $productValue * $quantity;
            $totalTax += $taxValue * $quantity;

            $saleProducts[] = new SaleProduct(
                $product['id'],
                $quantity,
                $productValue,
                $taxValue
            );
        }

        $createdAt = date('Y-m-d H:i:s');
        $sale = new Sale(null, $createdAt, $totalValue, $totalTax, $saleProducts);

        return $this->saleRepository->create($sale);
    }
}
