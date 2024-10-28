<?php
include 'productController.php';

if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];
    $productController = new ProductController();
    $product = $productController->getProductDetails($slug);
} else {
    echo "Producto no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto</title>
</head>
<body>
    <?php if ($product): ?>
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <p><strong>Marca:</strong> <?php echo htmlspecialchars($product['brand']); ?></p>
        <p><strong>Categorías:</strong> <?php echo htmlspecialchars(implode(', ', $product['categories'])); ?></p>
        <p><strong>Etiquetas:</strong> <?php echo htmlspecialchars(implode(', ', $product['tags'])); ?></p>
    <?php else: ?>
        <p>Detalles del producto no encontrados.</p>
    <?php endif; ?>
</body>
</html>
