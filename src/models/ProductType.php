<?php

class ProductType {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllProductTypes() {
        $stmt = $this->db->prepare("SELECT * FROM product_types");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createProductType($name, $tax_rate) {
        $stmt = $this->db->prepare("INSERT INTO product_types (name, tax_rate) VALUES (?, ?)");
        $stmt->execute([$name, $tax_rate]);
        return $this->db->lastInsertId();
    }
}
