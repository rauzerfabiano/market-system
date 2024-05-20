<?php
namespace App\Repositories;

use App\Database\Database;
use App\Models\ItemSale;
use App\Models\Sale;

use PDO;

class SaleRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Método para salvar um Sale no banco de dados
    public function save($sale) {
        $stmt = $this->db->prepare("INSERT INTO sales (total_tax, total_price) VALUES (?, ?)");
        $stmt->execute([0, 0]);
        $sale->setId($this->db->lastInsertId());
  
        return $sale;
    }

     public function update($saleId, $totalTax, $totalPrice) {
        $stmt = $this->db->prepare("UPDATE sales set total_tax = ?, total_price = ?  where id = ?");
        $stmt->execute(
            [
                $totalTax,
                $totalPrice, 
                $saleId
            ]);
  
        return true;
    }

    // Método para recuperar uma sale do banco de dados pelo ID
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM sales WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $itemSaleRepository = new ItemSaleRepository();
            $items = $itemSaleRepository->findAllByIdSale($data['id']);
            
            $sale = new Sale();
            $sale->setId($data['id']);
            $sale->setTotalPrice($data['total_price']);
            $sale->setTotalTax($data['total_tax']);
            $sale->setItems($items);
            return $sale;
        }
        return null;
    }

    // Método para recuperar todas sales
    public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM sales");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sales = [];
        
        if($data){
            foreach ($data as $row) {
                $itemSaleRepository = new ItemSaleRepository();
                $items = $itemSaleRepository->findAllByIdSale($row['id']);

                $sale = new Sale();
                $sale->setId($row['id']);
                $sale->setTotalPrice($row['total_price']);
                $sale->setTotalTax($row['total_tax']);
                $sale->setItems($items);

                array_push($sales,$sale->toArray());
            }
        }
        
        return $sales;
    }

    // Método para excluir um Sale do banco de dados
    public function delete(Sale $sale) {
        $stmt = $this->db->prepare("DELETE FROM sales WHERE id = ?");
        $stmt->execute([$sale->getId()]);
    }
}
