<?php
include 'ProductController.php';

$productController = new ProductController();

// Guardar detalles del producto
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image_url = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageTmpPath = $_FILES['image']['tmp_name'];
    $imageName = basename($_FILES['image']['name']);
    $uploadDir = 'uploads/';
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $targetFilePath = $uploadDir . $imageName;

    if (move_uploaded_file($imageTmpPath, $targetFilePath)) {
        $image_url = $targetFilePath;
    }
}

$newProduct = [
    'name' => $name,
    'description' => $description,
    'price' => $price,
    'image_url' => $image_url
];

$productController->createProduct($newProduct);

header("Location: home.php");
exit();
?>
