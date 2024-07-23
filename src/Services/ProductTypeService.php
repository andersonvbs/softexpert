<?php

namespace App\Services;

use App\Repositories\ProductTypeRepository;
Use App\Domain\Entities\ProductType;


class ProductTypeService
{
    private $productTypeRepository;

    public function __construct(ProductTypeRepository $productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    public function getProductTypes(): array
    {
        return $this->productTypeRepository->findAll();
    }

    public function createProductType($name): ProductType
    {
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = $createdAt;
        $product = new ProductType(null, $name, $createdAt, $updatedAt);

        return $this->productTypeRepository->create($product);
    }

    public function deleteProductType($id): bool
    {
        return $this->productTypeRepository->delete($id);
    }
}
