<?php
namespace App\Tests\Repositories;

use App\Models\Product;
use App\Models\ProductType;
use App\Repositories\ProductRepository;
use PDO;
use PHPUnit\Framework\TestCase;

class ProductRepositoryTest extends TestCase {
    private $productRepository;
    private $pdo;

    protected function setUp(): void {
        parent::setUp();
        // Configuração da conexão PDO em memória para os testes
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Criação da tabela products em memória
        $this->pdo->exec("CREATE TABLE products (
            id INTEGER PRIMARY KEY,
            name TEXT,
            price REAL,
            product_type_id INTEGER
        )");
        // Instanciação do ProductRepository com a conexão PDO em memória
        $this->productRepository = new ProductRepository($this->pdo);
    }

    public function testSave() {
        // Criação de um objeto ProductType
        $productType = new ProductType(1, "Test Type", 10.0);

        // Criação de um objeto Product para salvar no banco de dados
        $product = new Product(null, "Test Product", 20.0, $productType);

        // Salvar o objeto Product no banco de dados
        $this->productRepository->save($product);

        // Buscar o objeto Product pelo ID
        $savedProduct = $this->productRepository->findById($product->getId());

        // Verificação se o objeto recuperado é igual ao objeto salvo
        $this->assertEquals($product->getName(), $savedProduct->getName());
        $this->assertEquals($product->getPrice(), $savedProduct->getPrice());
        $this->assertEquals($product->getProductType()->getId(), $savedProduct->getProductType()->getId());
    }

    public function testFindAll() {
        // Criação de objetos ProductType
        $productType1 = new ProductType(1, "Type 1", 10.0);
        $productType2 = new ProductType(2, "Type 2", 20.0);

        // Salvar alguns objetos Product no banco de dados para testar findAll
        $product1 = new Product(null, "Product 1", 30.0, $productType1);
        $this->productRepository->save($product1);

        $product2 = new Product(null, "Product 2", 40.0, $productType2);
        $this->productRepository->save($product2);

        // Recuperar todos os objetos Product do banco de dados
        $products = $this->productRepository->findAll();

        // Verificar se a contagem de objetos recuperados é correta
        $this->assertCount(2, $products);

        // Verificar se os objetos recuperados têm os dados corretos
        $this->assertEquals("Product 1", $products[0]['name']);
        $this->assertEquals(30.0, $products[0]['price']);
        $this->assertEquals($productType1->getId(), $products[0]['product_type_id']);
        $this->assertEquals("Product 2", $products[1]['name']);
        $this->assertEquals(40.0, $products[1]['price']);
        $this->assertEquals($productType2->getId(), $products[1]['product_type_id']);
    }

    public function testFindById() {
        // Criação de um objeto ProductType
        $productType = new ProductType(1, "Test Type", 10.0);

        // Criação de um objeto Product e salvá-lo no banco de dados
        $product = new Product(null, "Test Product", 20.0, $productType);
        $this->productRepository->save($product);

        // Buscar o objeto Product pelo ID
        $foundProduct = $this->productRepository->findById($product->getId());

        // Verificar se o objeto recuperado é igual ao objeto salvo
        $this->assertEquals($product->getName(), $foundProduct->getName());
        $this->assertEquals($product->getPrice(), $foundProduct->getPrice());
        $this->assertEquals($product->getProductType()->getId(), $foundProduct->getProductType()->getId());
    }

    public function testUpdate() {
        // Criação de objetos ProductType
        $productType1 = new ProductType(1, "Type 1", 10.0);
        $productType2 = new ProductType(2, "Type 2", 20.0);

        // Criação de um objeto Product e salvá-lo no banco de dados
        $product = new Product(null, "Test Product", 30.0, $productType1);
        $this->productRepository->save($product);

        // Modificar os dados do objeto Product
        $product->setName("Updated Product");
        $product->setPrice(40.0);
        $product->setProductType($productType2);

        // Atualizar o objeto no banco de dados
        $this->productRepository->update($product);

        // Buscar o objeto atualizado pelo ID
        $updatedProduct = $this->productRepository->findById($product->getId());

        // Verificação se os dados foram atualizados corretamente
        $this->assertEquals("Updated Product", $updatedProduct->getName());
        $this->assertEquals(40.0, $updatedProduct->getPrice());
        $this->assertEquals($productType2->getId(), $updatedProduct->getProductType()->getId());
    }

    public function testDelete() {
        // Criação de um objeto ProductType
        $productType = new ProductType(1, "Test Type", 10.0);

        // Criação de um objeto Product e salvá-lo no banco de dados
        $product = new Product(null, "Test Product", 20.0, $productType);
        $this->productRepository->save($product);

        // Excluir o objeto do banco de dados
        $this->productRepository->delete($product);

        // Verificar se o objeto foi excluído corretamente
        $deletedProduct = $this->productRepository->findById($product->getId());
        $this->assertNull($deletedProduct);
    }
}
