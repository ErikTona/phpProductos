<?php
session_start();
include 'ProductController.php';

$productController = new ProductController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $brand_id = $_POST['brand_id'];

    $result = $productController->createProduct($name, $description, $price, $brand_id);

    if ($result) {
        header("Location: home.php");
    } else {
        echo "Error al crear el producto";
    }
}
?>
