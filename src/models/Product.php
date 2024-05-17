<?php

class Product {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllProducts() {
        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createProduct($name, $price) {
        $stmt = $this->db->prepare("INSERT INTO products (name, price) VALUES (?, ?)");
        $stmt->execute([$name, $price]);
        return $this->db->lastInsertId();
    }
}
