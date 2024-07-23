<?php

namespace App\Services;

use App\Repositories\ProductRepository;
Use App\Domain\Entities\Product;


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

    public function createProduct($name, $productTypeId, $price): Product
    {
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = $createdAt;
        $product = new Product(null, $name, $productTypeId, $price, $createdAt, $updatedAt);

        return $this->productRepository->create($product);
    }

    public function deleteProduct($id): bool
    {
        return $this->productRepository->delete($id);
    }
}
