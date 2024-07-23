<?php

use FastRoute\RouteCollector;
use App\Controllers\ProductController;
use App\Services\ProductService;
use App\Repositories\ProductRepository;


return function (RouteCollector $router) {
    $router->addRoute('GET', '/products', function() {
        $productRepository = new ProductRepository();
        $productService = new ProductService($productRepository);
        $productController = new ProductController($productService);
        $productController->getProducts();
    });
};
