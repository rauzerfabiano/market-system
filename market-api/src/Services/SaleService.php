<?php
namespace App\Services;

use App\Models\ItemSale;
use App\Models\Sale;
use App\Repositories\ItemSaleRepository;
use App\Repositories\SaleRepository;

class SaleService {
    private $saleRepository;

    public function __construct() {
        $this->saleRepository = new SaleRepository();
    }

    // Método para criar um novo Sale
    public function createSale($products) {
        $sale = new Sale();
        $sale = $this->saleRepository->save($sale);
        $totaxTax = 0;
        $totalPrice = 0;

        $itemSaleService = new ItemSaleService();
        $productService = new ProductService();
        foreach($products as $productItem){
            $product = $productService->getProductById($productItem['product_id']);
            $item = $itemSaleService->createItemSale($sale->getId(),$productItem['quantity'],$product);
            $totaxTax += $item->getTotalTax();
            $totalPrice += $item->getTotalItem();
        }

        $sale = $this->saleRepository->update($sale->getId(), $totaxTax, $totalPrice);
        return $sale;
    }

    // Método para recuperar uma sale pelo ID
    public function getSaleById($id) {
        return $this->saleRepository->findById($id);
    }

    // Método para recuperar uma sale pelo ID
    public function getSales() {
        return $this->saleRepository->findAll();
    }

    public function deleteSale($id) {
        $sale = $this->saleRepository->findById($id);
        if ($sale) {
            $itemSaleRepository = new ItemSaleRepository();
            $itemSaleRepository->delete($sale->getId());
            $this->saleRepository->delete($sale);
            return true;
        }
        return false; 
    }

}
