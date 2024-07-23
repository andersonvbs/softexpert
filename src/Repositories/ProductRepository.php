<?php

namespace App\Repositories;

use PDO;
use App\Domain\Entities\Product;
use App\Utils\Database;


class ProductRepository
{
    public function findAll(): array
    {
        $db = Database::getInstance();
        $pdo = $db->getConnection();
        $stmt = $pdo->query('SELECT * FROM products');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($results as $result) {
            $products[] = new Product(
                $result['id'],
                $result['name'],
                $result['created_at'],
                $result['updated_at']
            );
        }
        return $products;
    }
}
