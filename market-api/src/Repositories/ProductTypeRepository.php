<?php
namespace App\Repositories;

use App\Database\Database;
use App\Models\ProductType;
use PDO;

class ProductTypeRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Método para salvar um ProductType no banco de dados
    public function save($productType) {
        $stmt = $this->db->prepare("INSERT INTO product_types (name, tax_rate) VALUES (?, ?)");
        $stmt->execute([$productType->getName(), $productType->getTaxRate()]);
        $productType->setId($this->db->lastInsertId());
    }

    // Método para recuperar um ProductType do banco de dados pelo ID
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM product_types WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new ProductType($data['id'], $data['name'], $data['tax_rate']);
        }
        return null;
    }

     // Método para recuperar todos ProductType do banco de dados
     public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM product_types");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $products = [];
        if ($data) {
            foreach($data as $row) {
                $productType = new ProductType();
                $productType->setId($row['id']);
                $productType->setName($row['name']);
                $productType->setTaxRate($row['tax_rate']);
                $products[] = $productType->toArray();
            }
        }
        return $products;
    }
    

    // Método para atualizar um ProductType no banco de dados
    public function update(ProductType $productType) {
        $stmt = $this->db->prepare("UPDATE product_types SET name = ?, tax_rate = ? WHERE id = ?");
        $stmt->execute([$productType->getName(), $productType->getTaxRate(), $productType->getId()]);
    }

    // Método para excluir um ProductType do banco de dados
    public function delete(ProductType $productType) {
        $stmt = $this->db->prepare("DELETE FROM product_types WHERE id = ?");
        $stmt->execute([$productType->getId()]);
    }
}
