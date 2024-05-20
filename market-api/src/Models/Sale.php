<?php
namespace App\Models;
class Sale {
    private $id;
    private $items;
    private $totalPrice;
    private $totalTax;

    public function __construct($id = null, $totalPrice = null, $totalTax = null) {
        $this->id = $id;
        $this->totalPrice = $totalPrice;
        $this->totalTax = $totalTax;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTotalPrice() {
        return $this->totalPrice;
    }

    public function setTotalPrice($totalPrice) {
        $this->totalPrice = $totalPrice;
    }

    public function getTotalTax() {
        return $this->totalTax;
    }

    public function setTotalTax($totalTax) {
        $this->totalTax = $totalTax;
    }

    public function getItems() {
        return $this->items;
    }

    public function setItems($items) {
        $this->items = $items;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'total_price' => $this->totalPrice,
            'total_tax' => $this->totalTax,
            'items' => $this->items
        ];
    }
}
