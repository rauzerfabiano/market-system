<?php

class ProductController {
    private $productModel;

    public function __construct($productModel) {
        $this->productModel = $productModel;
    }

    public function listProducts() {
        $products = $this->productModel->getAllProducts();
        echo json_encode($products);
    }

    public function addProduct($name, $price) {
        $productId = $this->productModel->createProduct($name, $price);
        echo json_encode(['id' => $productId]);
    }
}
