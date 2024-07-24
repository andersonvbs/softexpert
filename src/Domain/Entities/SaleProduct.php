<?php

namespace App\Domain\Entities;


class SaleProduct
{
    public $productId;
    public $quantity;
    public $productValue;
    public $taxValue;

    public function __construct($productId, $quantity, $productValue, $taxValue)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->productValue = $productValue;
        $this->taxValue = $taxValue;
    }
}