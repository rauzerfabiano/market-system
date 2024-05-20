<?php
namespace App\Services;

use App\Models\Product;
use App\Models\ProductType;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTypeRepository;

class ProductService {
    private $productRepository;

    public function __construct() {
        $this->productRepository = new ProductRepository();
    }

    // Método para criar um novo Product
    public function createProduct($name, $price, $productTypeId) {
        $productType = new ProductType();
        $productType->setId($productTypeId);
        $product = new Product(null,$name, $price, $productType);
        $this->productRepository->save($product);
        return $product;
    }

    // Método para recuperar um Product pelo ID
    public function getProductById($id) {
        return $this->productRepository->findById($id);
    }

     // Método para recuperar todos tipos de produto
     public function getProducts() {
        return $this->productRepository->findAll();
    }

    // Método para atualizar um Product pelo ID
    public function updateProduct($id, $name, $price, $productTypeId) {
        $product = $this->productRepository->findById($id);
        $productTypeRepository = new ProductTypeRepository();
        $productType = $productTypeRepository->findById($productTypeId);

        if ($product) {
            $product->setName($name);
            $product->setPrice($price);
            $product->setProductType($productType);

            $this->productRepository->update($product);
            return $product;
        }
    }

    // Método para excluir um Product pelo ID
    public function deleteProduct($id) {
        $product = $this->productRepository->findById($id);
        if ($product) {
            $this->productRepository->delete($product);
            return true;
        }
        return false; 
    }
}
