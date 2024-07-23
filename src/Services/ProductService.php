<?php

namespace App\Services;

use App\Repositories\ProductRepository;


class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts(): array
    {
        return $this->productRepository->findAll();
    }
}
