<?php
namespace App\Tests\Repositories;

use App\Models\ProductType;
use App\Repositories\ProductTypeRepository;
use PDO;
use PHPUnit\Framework\TestCase;

class ProductTypeRepositoryTest extends TestCase {
    private $productTypeRepository;
    private $pdo;

    protected function setUp(): void {
        parent::setUp();
        // Configuração da conexão PDO em memória para os testes
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Criação da tabela product_types em memória
        $this->pdo->exec("CREATE TABLE product_types (
            id INTEGER PRIMARY KEY,
            name TEXT,
            tax_rate INTEGER
        )");
        // Instanciação do ProductTypeRepository com a conexão PDO em memória
        $this->productTypeRepository = new ProductTypeRepository($this->pdo);
    }

    public function testSave() {
        // Criação de um objeto ProductType para salvar no banco de dados
        $productType = new ProductType();
        $productType->setName("Test Product");
        $productType->setTaxRate(10);

        // Salvar o objeto ProductType no banco de dados
        $this->productTypeRepository->save($productType);

        // Buscar o objeto ProductType pelo ID
        $savedProductType = $this->productTypeRepository->findById($productType->getId());

        // Verificação se o objeto recuperado é igual ao objeto salvo
        $this->assertEquals($productType->getName(), $savedProductType->getName());
        $this->assertEquals($productType->getTaxRate(), $savedProductType->getTaxRate());
    }

    public function testFindAll() {
        // Salvar alguns objetos ProductType no banco de dados para testar findAll
        $productType1 = new ProductType();
        $productType1->setName("Test Product 1");
        $productType1->setTaxRate(10);
        $this->productTypeRepository->save($productType1);

        $productType2 = new ProductType();
        $productType2->setName("Test Product 2");
        $productType2->setTaxRate(20);
        $this->productTypeRepository->save($productType2);

        // Recuperar todos os objetos ProductType do banco de dados
        $products = $this->productTypeRepository->findAll();

        // Verificar se a contagem de objetos recuperados é correta
        $this->assertCount(2, $products);

        // Verificar se os objetos recuperados têm os dados corretos
        $this->assertEquals("Test Product 1", $products[0]->getName());
        $this->assertEquals(10, $products[0]->getTaxRate());
        $this->assertEquals("Test Product 2", $products[1]->getName());
        $this->assertEquals(20, $products[1]->getTaxRate());
    }

    public function testUpdate() {
        // Salvar um objeto ProductType no banco de dados
        $productType = new ProductType();
        $productType->setName("Test Product");
        $productType->setTaxRate(10);
        $this->productTypeRepository->save($productType);

        // Modificar os dados do objeto ProductType
        $productType->setName("Updated Product");
        $productType->setTaxRate(20);

        // Atualizar o objeto no banco de dados
        $this->productTypeRepository->update($productType);

        // Buscar o objeto atualizado pelo ID
        $updatedProductType = $this->productTypeRepository->findById($productType->getId());

        // Verificação se os dados foram atualizados corretamente
        $this->assertEquals("Updated Product", $updatedProductType->getName());
        $this->assertEquals(20, $updatedProductType->getTaxRate());
    }

    public function testDelete() {
        // Salvar um objeto ProductType no banco de dados
        $productType = new ProductType();
        $productType->setName("Test Product");
        $productType->setTaxRate(10);
        $this->productTypeRepository->save($productType);

        // Excluir o objeto do banco de dados
        $this->productTypeRepository->delete($productType);

        // Verificar se o objeto foi excluído corretamente
        $deletedProductType = $this->productTypeRepository->findById($productType->getId());
        $this->assertNull($deletedProductType);
    }
}
