<?php
namespace App\Controllers;

use App\Services\SaleService;

class SaleController {
    private $saleService;

    public function __construct() {
        $this->saleService = new SaleService();
    }

    // Método para criar um novo Sale
    public function createSale($products) {
        $this->saleService->createSale($products);
        // Retorna uma mensagem JSON de sucesso
        return json_encode(["message" => "Sale created successfully"]);
    }

    public function getSaleById($id) {
        $sale = $this->saleService->getSaleById($id);
        if($sale){
            $sale = $sale->toArray();
        }
        // Retorna o Product em formato JSON
        return json_encode($sale);
    }

    public function getSales() {
        $sales = $this->saleService->getSales();
        // Retorna todos os tipos de produto em formato JSON
        return json_encode($sales);
    }


    public function deleteSale($id) {
        if ($id) {
            $this->saleService->deleteSale($id);
            // Retorna uma mensagem JSON de sucesso
            return json_encode(["message" => "Product deleted successfully"]);
        } else {
            // Retorna uma mensagem JSON de erro se o Product não foi encontrado
            return json_encode(["error" => "Product not found"]);
        }
    }
}
?>
