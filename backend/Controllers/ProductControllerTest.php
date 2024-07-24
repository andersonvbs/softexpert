<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\ProductController;
use App\Services\ProductService;
use App\Domain\Entities\Product;

class ProductControllerTest extends TestCase
{
    public function testGetProducts()
    {
        // Mock ProductService
        $productServiceMock = $this->createMock(ProductService::class);

        // Create a list of products
        $products = [
            new Product(1, 'Product 1', '2023-07-20 10:00:00', '2023-07-20 10:00:00'),
            new Product(2, 'Product 2', '2023-07-21 11:00:00', '2023-07-21 11:00:00')
        ];

        // Configure the stub.
        $productServiceMock->method('getProducts')
            ->willReturn($products);

        // Instantiate the controller with the mock
        $controller = new ProductController($productServiceMock);

        // Start output buffering
        ob_start();
        $controller->getProducts();
        $output = ob_get_clean();

        // Decode the JSON response
        $response = json_decode($output, true);

        // Assertions
        $this->assertCount(2, $response);
        $this->assertEquals('Product 1', $response[0]['name']);
        $this->assertEquals('Product 2', $response[1]['name']);
    }
}