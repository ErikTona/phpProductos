<?php
session_start();
include 'ProductController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $productController = new ProductController();
    $result = $productController->updateProduct($id, $name, $description, $price);

    if ($result) {
        header('Location: home.php?message=Producto actualizado exitosamente');
    } else {
        header('Location: home.php?error=Error al actualizar el producto');
    }
}
?>
