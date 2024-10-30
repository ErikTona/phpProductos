<?php
session_start();
include 'ProductController.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Lee el cuerpo de la solicitud para obtener el ID del producto
    $input = json_decode(file_get_contents("php://input"), true);
    $productId = $input['id'] ?? null;

    if ($productId) {
        $productController = new ProductController();
        $result = $productController->deleteProduct($productId);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el producto.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID de producto inválido.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no permitido.']);
}
