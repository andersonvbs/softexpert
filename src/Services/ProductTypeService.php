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

    public function createProductType($name, $taxPercentage): ProductType
    {
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = $createdAt;
        $productType = new ProductType(null, $name, $taxPercentage, $createdAt, $updatedAt);

        return $this->productTypeRepository->create($productType);
    }

    public function deleteProductType($id): bool
    {
        return $this->productTypeRepository->delete($id);
    }
}
