<?php
session_start();
include 'ProductController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $productController = new ProductController();
    $result = $productController->createProduct($name, $description, $price);

    if ($result) {
        header('Location: home.php?message=Producto creado exitosamente');
    } else {
        header('Location: home.php?error=Error al crear el producto');
    }
}
?>
