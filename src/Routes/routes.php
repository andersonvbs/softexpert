<?php

use FastRoute\RouteCollector;
use App\Controllers\ProductController;
use App\Services\ProductService;
use App\Repositories\ProductRepository;


return function (RouteCollector $router) {
    $productRepository = new ProductRepository();
    $productService = new ProductService($productRepository);
    $productController = new ProductController($productService);

    $router->addRoute('GET', '/products', function() use ($productController) {
        $productController->getProducts();
    });

    $router->addRoute('POST', '/products', function() use ($productController) {
        $productController->createProduct();
    });

    $router->addRoute('DELETE', '/products/{id:\d+}', function($vars) use ($productController) {
        $productController->deleteProduct($vars);
    });
};
