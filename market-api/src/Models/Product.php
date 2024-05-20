<?php
namespace App\Models;

class Product {
    private $id;
    private $name;
    private $price;
    private $productType;

    public function __construct($id = null, $name = null, $price = null, $productType = null) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->productType = $productType;
    }
    public function getId(): mixed
    {
        return $this->id;
    }

    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    public function getName(): mixed
    {
        return $this->name;
    }

    public function setName(mixed $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): mixed
    {
        return $this->price;
    }

    public function setPrice(mixed $price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * @param mixed $productTypeId
     */
    public function setProductType($productType): void
    {
        $this->productType = $productType;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'product_type' => $this->productType->toArray(),
        ];
    }
}
