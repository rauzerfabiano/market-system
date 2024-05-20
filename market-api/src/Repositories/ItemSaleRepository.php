<?php
namespace App\Repositories;

use App\Database\Database;
use App\Models\ItemSale;
use App\Models\Product;
use PDO;

class ItemSaleRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Método para salvar um ItemSale no banco de dados
    public function save($saleId,$itemSale) {
        $stmt = $this->db->prepare("INSERT INTO items_sale (product_id, sale_id, price, quantity, total_tax, total_item) VALUES (?, ?, ?, ?, ?, ?);");
        $stmt->execute(
            [
                $itemSale->getProductId(), 
                $saleId,
                $itemSale->getPrice(), 
                $itemSale->getQuantity(), 
                $itemSale->getTotalTax(), 
                $itemSale->getTotalItem(), 
            ]);
        $itemSale->setId($this->db->lastInsertId());
        
        return $itemSale;
    }


     // Método para recuperar todos ItemSale do banco de dados
     public function findAllByIdSale($saleId) {
        $stmt = $this->db->prepare("SELECT * 
                                    FROM items_sale 
                                    where sale_id = ?");
        $stmt->execute([$saleId]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $itemSales = [];
        if ($data) {
            foreach($data as $row) {
                $productRepository = new ProductRepository();
                $product = $productRepository->findById($row['product_id']);
           
                $itemSale = new ItemSale();
                $itemSale->setId($row['id']);
                $itemSale->setSaleId($row['sale_id']);
                $itemSale->setPrice($row['price']);
                $itemSale->setQuantity($row['quantity']);
                $itemSale->setTotalTax($row['total_tax']);
                $itemSale->setTotalItem($row['total_item']);
                $itemSale->setProduct($product);

                array_push($itemSales,$itemSale->toArray());
            }
        }
        return $itemSales;
    }
    

    // Método para excluir um ItemSale do banco de dados
    public function delete($saleId) {
        $stmt = $this->db->prepare("DELETE FROM items_sale WHERE sale_id = ?");
        $stmt->execute([$saleId]);
    }
}
