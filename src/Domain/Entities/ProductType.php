<?php

namespace App\Domain\Entities;


class ProductType
{
    public $id;
    public $name;
    public $taxPercentage;
    public $createdAt;
    public $updatedAt;

    public function __construct($id, $name, $taxPercentage, $createdAt, $updatedAt = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->taxPercentage = $taxPercentage;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}
