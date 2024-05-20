<?php
namespace App\Repositories;

use App\Database\Database;
use App\Models\Product;

use PDO;

class ProductRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Método para salvar um Product no banco de dados
    public function save($product) {
        $stmt = $this->db->prepare("INSERT INTO products (name, price, product_type_id) VALUES (?, ?, ?)");
        $stmt->execute([$product->getName(), $product->getPrice(), $product->getProductType()->getId()]);
        $product->setId($this->db->lastInsertId());
    }

    // Método para recuperar um Product do banco de dados pelo ID
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT products.* FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $productTypeRepository = new ProductTypeRepository();
            $productType = $productTypeRepository->findById($data['product_type_id']);

            return new Product($data['id'], $data['name'], $data['price'], $productType);
        }
        return null;
    }

     // Método para recuperar todos Product do banco de dados
     public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $products = [];
        if ($data) {
            foreach($data as $row) {
                $productTypeRepository = new ProductTypeRepository();
                $productType = $productTypeRepository->findById($row['product_type_id']);

                $product = new Product();
                $product->setId($row['id']);
                $product->setName($row['name']);
                $product->setPrice($row['price']);
                $product->setProductType($productType);
                $products[] = $product->toArray();
            }
        }
        return $products;
    }
    

    // Método para atualizar um Product no banco de dados
    public function update(Product $product) {
        $stmt = $this->db->prepare("UPDATE products SET name = ?, price = ?, product_type_id = ? WHERE id = ?");
        $stmt->execute([$product->getName(), $product->getPrice(), $product->getProductType()->getId(), $product->getId()]);
    }

    // Método para excluir um Product do banco de dados
    public function delete(Product $product) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$product->getId()]);
    }
}
