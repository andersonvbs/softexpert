<?php

namespace App\Domain\Entities;


class Product
{
    public $id;
    public $name;
    public $productTypeId;
    public $price;
    public $createdAt;
    public $updatedAt;

    public function __construct($id, $name, $productTypeId, $price, $createdAt, $updatedAt = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->productTypeId = $productTypeId;
        $this->price = $price;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}
