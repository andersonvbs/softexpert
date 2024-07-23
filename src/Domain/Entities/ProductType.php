<?php

namespace App\Domain\Entities;


class ProductType
{
    public $id;
    public $name;
    public $createdAt;
    public $updatedAt;

    public function __construct($id, $name, $createdAt, $updatedAt = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}
