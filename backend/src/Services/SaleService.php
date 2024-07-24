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

    public function getSales(): array
    {
        return $this->saleRepository->findAll();
    }

    public function createSale($products): Sale
    {
        $totalValue = 0;
        $totalTax = 0;
        $saleProducts = [];

        foreach ($products as $product) {
            $productPrice = $product['price'];
            $quantity = $product['quantity'];
            $taxPercentage = $product['taxPercentage'];
            $taxValue = $productPrice * ($taxPercentage / 100);

            $totalValue += $productPrice * $quantity;
            $totalTax += $taxValue * $quantity;

            $saleProducts[] = new SaleProduct(
                $product['id'],
                $quantity,
                $productPrice,
                $taxValue
            );
        }

        $createdAt = date('Y-m-d H:i:s');
        $sale = new Sale(null, $createdAt, $totalValue, $totalTax, $saleProducts);

        return $this->saleRepository->create($sale);
    }
}
