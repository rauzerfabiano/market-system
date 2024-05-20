<?php
namespace App\Controllers;

use App\Services\ProductService;

class ProductController {
    private $productService;

    public function __construct() {
        $this->productService = new ProductService();
    }

    // Método para criar um novo Product
    public function createProduct($name, $price, $productTypeId) {
        $this->productService->createProduct($name, $price, $productTypeId);
        // Retorna uma mensagem JSON de sucesso
        return json_encode(["message" => "Product created successfully"]);
    }

    // Método para recuperar um Product pelo ID
    public function getProductById($id) {
        $product = $this->productService->getProductById($id);
        if($product){
            $product = $product->toArray();
        }
        // Retorna o Product em formato JSON
        return json_encode($product);
    }

    // Método para recuperar todos tipos de produto
    public function getProducts() {
        $products = $this->productService->getProducts();
        // Retorna todos os tipos de produto em formato JSON
        return json_encode($products);
    }

    // Método para atualizar um Product
    public function updateProduct($id, $name, $price, $productTypeId) {
        $product = $this->productService->updateProduct($id, $name, $price, $productTypeId);
        return json_encode(["message" => "Product updated successfully"]);
    }

    // Método para excluir um Product
    public function deleteProduct($id) {
        if ($id) {
            $this->productService->deleteProduct($id);
            // Retorna uma mensagem JSON de sucesso
            return json_encode(["message" => "Product deleted successfully"]);
        } else {
            // Retorna uma mensagem JSON de erro se o Product não foi encontrado
            return json_encode(["error" => "Product not found"]);
        }
    }
}
?>
