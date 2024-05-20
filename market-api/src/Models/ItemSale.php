<?php
namespace App\Models;
class ItemSale {
    private $id;
    private $productId;
    private $saleId;
    private $price;
    private $quantity;
    private $totalTax;
    private $totalItem;
    private $product;

    public function __construct($id = null, $productId = null, $price = null, $quantity = null, $totalTax = null, $totalItem = null, $saleId = null) {
        $this->id = $id;
        $this->productId = $productId;
        $this->saleId = $saleId;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->totalTax = $totalTax;
        $this->totalItem = $totalItem;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }


    public function getSaleId() {
        return $this->saleId;
    }

    public function setSaleId($saleId) {
        $this->saleId = $saleId;
    }


    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getTotalTax() {
        return $this->totalTax;
    }

    public function setTotalTax($totalTax) {
        $this->totalTax = $totalTax;
    }

    public function getTotalItem() {
        return $this->totalItem;
    }

    public function setTotalItem($totalItem) {
        $this->totalItem = $totalItem;
    }

    public function getProduct() {
        return $this->product;
    }

    public function setProduct($product) {
        $this->product = $product;
    }


    public function toArray() {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'sale' => $this->saleId,
            'quantity' => $this->quantity,
            'total_tax' => $this->totalTax,
            'total_item' => $this->totalItem,
            'product' => $this->product->toArray(),
        ];
    }
}
