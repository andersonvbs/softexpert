<?php

namespace App\Repositories;

use PDO;
use App\Domain\Entities\ProductType;
use App\Utils\Database;


class ProductTypeRepository
{
    private $pdo;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->pdo = $db->getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM softexpert.product_type');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($results as $result) {
            $products[] = new ProductType(
                $result['id'],
                $result['name'],
                $result['tax_percentage'],
                $result['created_at'],
                $result['updated_at']
            );
        }
        return $products;
    }

    public function create(ProductType $productType): ProductType
    {
        $stmt = $this->pdo->prepare('INSERT INTO softexpert.product_type (name, tax_percentage, created_at, updated_at) VALUES (:name, :tax_percentage, :created_at, :updated_at) RETURNING id');
        $stmt->execute([
            ':name' => $productType->name,
            ':tax_percentage' => $productType->taxPercentage,
            ':created_at' => $productType->createdAt,
            ':updated_at' => $productType->updatedAt,
        ]);

        $productTypeId = $stmt->fetchColumn();
        return new ProductType($productTypeId, $productType->name, $productType->taxPercentage, $productType->createdAt, $productType->updatedAt);
    }

    public function delete($id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM softexpert.product_type WHERE id = :id');
        $stmt->execute([':id' => $id]);

        return $stmt->rowCount() > 0;
    }
}
