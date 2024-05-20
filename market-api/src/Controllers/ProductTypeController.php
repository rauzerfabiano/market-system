<?php
namespace App\Controllers;

use App\Services\ProductTypeService;

class ProductTypeController {
    private $productTypeService;

    public function __construct() {
        $this->productTypeService = new ProductTypeService();
    }

    // Método para criar um novo ProductType
    public function createProductType($name, $taxRate) {
        $this->productTypeService->createProductType($name, $taxRate);
        // Retorna uma mensagem JSON de sucesso
        return json_encode(["message" => "ProductType created successfully"]);
    }

    // Método para recuperar um ProductType pelo ID
    public function getProductTypeById($id) {
        $productType = $this->productTypeService->getProductTypeById($id);
        if($productType){
            $productType = $productType->toArray();
        }
        // Retorna o ProductType em formato JSON
        return json_encode($productType);
    }

    // Método para recuperar todos tipos de produto
    public function getProducts() {
        $products = $this->productTypeService->getProducts();
        // Retorna todos os tipos de produto em formato JSON
        return json_encode($products);
    }

    // Método para atualizar um ProductType
    public function updateProductType($id, $name, $taxRate) {
        $productType = $this->productTypeService->updateProductType($id, $name, $taxRate);
        return json_encode(["message" => "Product type updated successfully"]);
    }

    // Método para excluir um ProductType
    public function deleteProductType($id) {
        if ($id) {
            $this->productTypeService->deleteProductType($id);
            // Retorna uma mensagem JSON de sucesso
            return json_encode(["message" => "ProductType deleted successfully"]);
        } else {
            // Retorna uma mensagem JSON de erro se o ProductType não foi encontrado
            return json_encode(["error" => "ProductType not found"]);
        }
    }
}
?>
