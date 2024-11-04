<?php
session_start();
include 'ProductController.php';

if (!isset($_SESSION['global_token'])) {
    $_SESSION['global_token'] = bin2hex(random_bytes(32));
}

$productController = new ProductController();
$products = $productController->getProducts();
$brands = $productController->getBrands();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Productos</title>
  <link href="home.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

  <!-- Contenido principal -->
  <main class="container my-4">
    <h3>Gestionar Productos</h3>

    <!-- Formulario para crear producto -->
    <form id="productForm" action="createProduct.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="global_token" value="<?php echo $_SESSION['global_token']; ?>">
        
        <div class="mb-3">
            <label for="productName" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" name="name" id="productName" required>
        </div>
        <div class="mb-3">
            <label for="productDescription" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="description" id="productDescription" required>
        </div>
        <div class="mb-3">
            <label for="productPrice" class="form-label">Precio</label>
            <input type="number" class="form-control" name="price" id="productPrice" required>
        </div>
        <div class="mb-3">
            <label for="productBrand" class="form-label">Marca</label>
            <select class="form-control" name="brand_id" id="productBrand">
                <?php foreach ($brands as $brand): ?>
                    <option value="<?php echo $brand['id']; ?>"><?php echo $brand['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Producto</button>
    </form>

    <!-- Mostrar productos -->
    <div class="row mt-4">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo $product['image_url'] ?? 'https://via.placeholder.com/150'; ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                        <button class="btn btn-warning" onclick="loadProductData(<?php echo htmlspecialchars(json_encode($product)); ?>)">Editar</button>
                        <button class="btn btn-danger" onclick="deleteProduct(<?php echo $product['id']; ?>)">Eliminar</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
  </main>

  <script>
    function loadProductData(product) {
        document.getElementById('productId').value = product.id;
        document.getElementById('productName').value = product.name;
        document.getElementById('productDescription').value = product.description;
        document.getElementById('productPrice').value = product.price;
        document.getElementById('productForm').action = 'editProduct.php';
    }

    function deleteProduct(productId) {
        axios.post('deleteProduct.php', {
            global_token: '<?php echo $_SESSION['global_token']; ?>',
            product_id: productId
        })
        .then(response => {
            if (response.data.success) {
                alert('Producto eliminado correctamente');
                location.reload();
            } else {
                alert('Error al eliminar el producto');
            }
        })
        .catch(error => console.error('Error:', error));
    }
  </script>
</body>
</html>
