<?php

class SalesService {
    private $productModel;
    private $productTypeModel;

    public function __construct($productModel, $productTypeModel) {
        $this->productModel = $productModel;
        $this->productTypeModel = $productTypeModel;
    }

    public function calculateTotal($productId, $quantity) {
        $product = $this->productModel->getProductById($productId);
        $productType = $this->productTypeModel->getProductTypeById($product['type_id']);
        $price = $product['price'];
        $taxRate = $productType['tax_rate'];

        $totalPrice = $price * $quantity;
        $taxAmount = $totalPrice * ($taxRate / 100);

        return [
            'totalPrice' => $totalPrice,
            'taxAmount' => $taxAmount
        ];
    }
}
