<?php
namespace App\Services;

use App\Models\ItemSale;
use App\Repositories\ItemSaleRepository;

class ItemSaleService {
    private $itemSaleRepository;

    public function __construct() {
        $this->itemSaleRepository = new ItemSaleRepository();
    }

    // Método para criar um novo ItemSale
    public function createItemSale($saleId,$quantity,$product) {
        $taxRate = $this->calcuteTax($product->getPrice(), $product->getProductType()->getTaxRate(),$quantity);
        $total = $product->getPrice() * $quantity;
        $itemSale = new ItemSale(null,$product->getId(),$product->getPrice(),$quantity,$taxRate,$total,$saleId);
        $itemSale = $this->itemSaleRepository->save($saleId,$itemSale);

        return $itemSale;
    }

    // Método para recuperar um ItemSale pelo ID
    public function getItemSaleByIdSale($idSale) {
        return $this->itemSaleRepository->findById($idSale);
    }

    public function calcuteTax($price, $tax, $quantity): float
    {
        return (($price * $tax) / 100) * $quantity;
    }

}
