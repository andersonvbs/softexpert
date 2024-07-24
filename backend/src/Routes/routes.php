<?php

use FastRoute\RouteCollector;
use App\Controllers\ProductController;
use App\Controllers\ProductTypeController;
use App\Controllers\SaleController;
use App\Services\ProductService;
use App\Services\ProductTypeService;
use App\Services\SaleService;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTypeRepository;
use App\Repositories\SaleRepository;


return function (RouteCollector $router) {
    $productRepository = new ProductRepository();
    $productService = new ProductService($productRepository);
    $productController = new ProductController($productService);

    $productTypeRepository = new ProductTypeRepository();
    $productTypeService = new ProductTypeService($productTypeRepository);
    $productTypeController = new ProductTypeController($productTypeService);

    $saleRepository = new SaleRepository();
    $saleService = new SaleService($saleRepository);
    $saleController = new SaleController($saleService);

    /** Product routes */
    $router->addRoute('GET', '/products', function() use ($productController) {
        $productController->getProducts();
    });

    $router->addRoute('POST', '/products', function() use ($productController) {
        $productController->createProduct();
    });

    $router->addRoute('DELETE', '/products/{id:\d+}', function($vars) use ($productController) {
        $productController->deleteProduct($vars);
    });

    /** Product type routes */
    $router->addRoute('GET', '/product_types', function() use ($productTypeController) {
        $productTypeController->getProductTypes();
    });

    $router->addRoute('POST', '/product_types', function() use ($productTypeController) {
        $productTypeController->createProductType();
    });

    $router->addRoute('DELETE', '/product_types/{id:\d+}', function($vars) use ($productTypeController) {
        $productTypeController->deleteProductType($vars);
    });

    /** Sales route */
    $router->addRoute('POST', '/sales', function() use ($saleController) {
        $saleController->createSale();
    });
};
