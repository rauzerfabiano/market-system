<?php
namespace App\Models;

class ProductType {
    private $id = null;
    private $name;
    private $taxRate;

    public function __construct($id = null, $name = null, $taxRate = null) {
        $this->id = $id;
        $this->name = $name;
        $this->taxRate = $taxRate;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getTaxRate() {
        return $this->taxRate;
    }

    public function setTaxRate($taxRate) {
        $this->taxRate = $taxRate;
    }
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'tax_rate' => $this->taxRate
        ];
    }
}
