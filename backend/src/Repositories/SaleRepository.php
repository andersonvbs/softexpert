<?php

namespace App\Repositories;

use PDO;
use App\Domain\Entities\Sale;
use App\Domain\Entities\SaleProduct;
use App\Utils\Database;


class SaleRepository
{
    private $pdo;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->pdo = $db->getConnection();
    }

    public function create(Sale $sale): Sale
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare('INSERT INTO softexpert.sales (created_at, total_value, total_tax) VALUES (:created_at, :total_value, :total_tax) RETURNING id');
            $stmt->execute([
                ':created_at' => $sale->createdAt,
                ':total_value' => $sale->totalValue,
                ':total_tax' => $sale->totalTax,
            ]);

            $saleId = $stmt->fetchColumn();

            $saleProducts = $sale->products;
            foreach ($saleProducts as $saleProduct) {
                $stmt = $this->pdo->prepare('INSERT INTO softexpert.sales_products (sale_id, product_id, quantity, product_value, tax_value) VALUES (:sale_id, :product_id, :quantity, :product_value, :tax_value)');
                $stmt->execute([
                    ':sale_id' => $saleId,
                    ':product_id' => $saleProduct->productId,
                    ':quantity' => $saleProduct->quantity,
                    ':product_value' => $saleProduct->productValue,
                    ':tax_value' => $saleProduct->taxValue,
                ]);
            }

            $this->pdo->commit();

            return new Sale($saleId, $sale->createdAt, $sale->totalValue, $sale->totalTax, $saleProducts);
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}
