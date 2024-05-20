<?php
namespace App\Services;

use App\Models\ProductType;
use App\Repositories\ProductTypeRepository;

class ProductTypeService {
    private $productTypeRepository;

    public function __construct() {
        $this->productTypeRepository = new ProductTypeRepository();
    }

    // Método para criar um novo ProductType
    public function createProductType($name, $taxRate) {
        $productType = new ProductType(null,$name, $taxRate);
        $this->productTypeRepository->save($productType);
        return $productType;
    }

    // Método para recuperar um ProductType pelo ID
    public function getProductTypeById($id) {
        return $this->productTypeRepository->findById($id);
    }

     // Método para recuperar todos tipos de produto
     public function getProducts() {
        return $this->productTypeRepository->findAll();
    }

    // Método para atualizar um ProductType pelo ID
    public function updateProductType($id, $name, $taxRate) {
        $productType = $this->productTypeRepository->findById($id);
        if ($productType) {
            $productType->setName($name);
            $productType->setTaxRate($taxRate);
            $this->productTypeRepository->update($productType);
            return $productType;
        }
    }

    // Método para excluir um ProductType pelo ID
    public function deleteProductType($id) {
        $productType = $this->productTypeRepository->findById($id);
        if ($productType) {
            $this->productTypeRepository->delete($productType);
            return true;
        }
        return false; 
    }
}
