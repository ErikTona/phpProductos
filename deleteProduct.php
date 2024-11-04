<?php
session_start();
include 'ProductController.php';

$productController = new ProductController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $globalToken = $_POST['global_token'];

    if ($globalToken !== $_SESSION['global_token']) {
        die("Acceso denegado: token no válido.");
    }

    $success = $productController->deleteProduct($productId);

    echo json_encode(['success' => $success]);
}
?>
