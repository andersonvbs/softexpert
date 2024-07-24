<?php

namespace App\Domain\Entities;


class Sale
{
    public $id;
    public $createdAt;
    public $totalValue;
    public $totalTax;
    public $products;

    public function __construct($id, $createdAt, $totalValue, $totalTax, $products = [])
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->totalValue = $totalValue;
        $this->totalTax = $totalTax;
        $this->products = $products;
    }
}