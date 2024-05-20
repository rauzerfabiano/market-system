<?php

use App\Controllers\ProductController;
use App\Controllers\ProductTypeController;
use App\Controllers\SaleController;

require_once __DIR__ . '/../vendor/autoload.php';

// Cria uma instância do ProductTypeController
$productTypeController = new ProductTypeController();
$productController = new ProductController();
$saleController = new SaleController();

// Obtém o corpo da requisição em JSON
$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);

// Roteamento
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Headers para permitir requisições de qualquer origem (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Max-Age: 3600");

// Se a requisição for do tipo OPTIONS, retorna 200 OK
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Roteamento com base na URI
switch ($uri) {
    case '/product-types':
        if ($method === 'GET') {
            echo $productTypeController->getProducts();
        } elseif ($method === 'POST') {
            // Verifica se os dados necessários estão presentes no corpo da requisição
            if (!isset($data['name']) || !isset($data['tax_rate'])) {
                http_response_code(400);
                echo json_encode(["error" => "Missing required parameters"]);
                exit();
            }

            // Extrai os dados do corpo da requisição JSON
            $name = $data['name'];
            $taxRate = $data['tax_rate'];
            echo $productTypeController->createProductType($name, $taxRate);
        } else {
            // Retorna erro 400 Bad Request para métodos de requisição inválidos
            http_response_code(400);
            echo json_encode(["error" => "Page not found"]);
        }
        break;
    case (preg_match('/\/product-types\/(\d+)/', $uri, $matches) ? true : false):
        $productTypeId = $matches[1];
        switch ($method) {
            case 'GET':
                echo $productTypeController->getProductTypeById($productTypeId);
                break;
            case 'PUT':
                $name = $data['name'];
                $taxRate = $data['tax_rate'];
                echo $productTypeController->updateProductType($productTypeId, $name, $taxRate);
                break;
            case 'DELETE':
                echo $productTypeController->deleteProductType($productTypeId);
                break;
            default:
                // Retorna erro 400 Bad Request para métodos de requisição inválidos
                http_response_code(400);
                echo json_encode(["error" => "Page not found"]);
                break;
        }
        break;
    case '/sales':
        if ($method === 'GET') {
            echo $saleController->getSales();
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            echo $saleController->createSale($data['products']);
        } else {
            // Retorna erro 400 Bad Request para métodos de requisição inválidos
            http_response_code(400);
            echo json_encode(["error" => "Page not found"]);
        }
        break;
    case (preg_match('/\/sales\/(\d+)/', $uri, $matches) ? true : false):
        $saleId = $matches[1];
        switch ($method) {
            case 'GET':
                echo $saleController->getSaleById($saleId);
                break;
            case 'DELETE':
                echo $saleController->deleteSale($saleId);
                break;
            default:
                // Retorna erro 400 Bad Request para métodos de requisição inválidos
                http_response_code(400);
                echo json_encode(["error" => "Page not found"]);
                break;
        }
        break;
        case '/products':
            if ($method === 'GET') {
                echo $productController->getProducts();
            } elseif ($method === 'POST') {
                // Verifica se os dados necessários estão presentes no corpo da requisição
                if (!isset($data['name']) || !isset($data['price']) || !isset($data['product_type_id'])) {
                    http_response_code(400);
                    echo json_encode(["error" => "Missing required parameters"]);
                    exit();
                }
    
                // Extrai os dados do corpo da requisição JSON
                $name = $data['name'];
                $price = $data['price'];
                $productTypeId = $data['product_type_id'];
                echo $productController->createproduct($name, $price, $productTypeId);
            } else {
                // Retorna erro 400 Bad Request para métodos de requisição inválidos
                http_response_code(400);
                echo json_encode(["error" => "Page not found"]);
            }
            break;
        case (preg_match('/\/products\/(\d+)/', $uri, $matches) ? true : false):
            $productId = $matches[1];
            switch ($method) {
                case 'GET':
                    echo $productController->getproductById($productId);
                    break;
                case 'PUT':
                    if (!isset($data['name']) || !isset($data['price']) || !isset($data['product_type_id'])) {
                        http_response_code(400);
                        echo json_encode(["error" => "Missing required parameters"]);
                        exit();
                    }
                    // Extrai os dados do corpo da requisição JSON
                    $name = $data['name'];
                    $price = $data['price'];
                    $productTypeId = $data['product_type_id'];
                    echo $productController->updateproduct($productId, $name, $price, $productTypeId);
                    break;
                case 'DELETE':
                    echo $productController->deleteproduct($productId);
                    break;
                default:
                    // Retorna erro 400 Bad Request para métodos de requisição inválidos
                    http_response_code(400);
                    echo json_encode(["error" => "Page not found"]);
                    break;
            }
            break;
    default:
        // Retorna erro 400 Bad Request para URIs desconhecidas
        http_response_code(400);
        echo json_encode(["error" => "Page not found"]);
        break;
}
