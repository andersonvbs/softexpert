<?php

namespace App\Repositories;

use PDO;
use App\Domain\Entities\Product;
use App\Utils\Database;


class ProductRepository
{
    private $pdo;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->pdo = $db->getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT p.*, pt.name as product_type_name, pt.tax_percentage FROM softexpert.products p JOIN softexpert.product_type pt ON p.product_type_id = pt.id');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($results as $result) {
            $products[] = new Product(
                $result['id'],
                $result['name'],
                $result['product_type_id'],
                $result['price'],
                $result['created_at'],
                $result['updated_at'],
                $result['product_type_name'],
                $result['tax_percentage'],
            );
        }
        return $products;
    }

    public function create(Product $product): Product
    {
        $stmt = $this->pdo->prepare('INSERT INTO softexpert.products (name, product_type_id, price, created_at, updated_at) VALUES (:name, :product_type_id, :price, :created_at, :updated_at) RETURNING id');
        $stmt->execute([
            ':name' => $product->name,
            ':product_type_id' => $product->productTypeId,
            ':price' => $product->price,
            ':created_at' => $product->createdAt,
            ':updated_at' => $product->updatedAt,
        ]);

        $productId = $stmt->fetchColumn();
        return new Product($productId, $product->name, $product->productTypeId, $product->price, $product->createdAt, $product->updatedAt);
    }

    public function delete($id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM softexpert.products WHERE id = :id');
        $stmt->execute([':id' => $id]);

        return $stmt->rowCount() > 0;
    }
}
