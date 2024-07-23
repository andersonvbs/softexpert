<?php

use FastRoute\RouteCollector;
use App\Controllers\ProductController;
use App\Controllers\ProductTypeController;
use App\Services\ProductService;
use App\Services\ProductTypeService;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTypeRepository;


return function (RouteCollector $router) {
    $productRepository = new ProductRepository();
    $productService = new ProductService($productRepository);
    $productController = new ProductController($productService);

    $productTypeRepository = new ProductTypeRepository();
    $productTypeService = new ProductTypeService($productTypeRepository);
    $productTypeController = new ProductTypeController($productTypeService);

    $router->addRoute('GET', '/products', function() use ($productController) {
        $productController->getProducts();
    });

    $router->addRoute('POST', '/products', function() use ($productController) {
        $productController->createProduct();
    });

    $router->addRoute('DELETE', '/products/{id:\d+}', function($vars) use ($productController) {
        $productController->deleteProduct($vars);
    });


    $router->addRoute('GET', '/product_types', function() use ($productTypeController) {
        $productTypeController->getProductTypes();
    });

    $router->addRoute('POST', '/product_types', function() use ($productTypeController) {
        $productTypeController->createProductType();
    });

    $router->addRoute('DELETE', '/product_types/{id:\d+}', function($vars) use ($productTypeController) {
        $productTypeController->deleteProductType($vars);
    });
};
