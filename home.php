<?php
session_start();
require_once 'ProductController.php';

// Instanciar controlador y obtener productos
$controller = new ProductController();
$productos = $controller->getProducts();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav</title>
    <link href="home.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Tienda</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Carrito</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link active" href="#">Categorías</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Electrónica</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Ropa</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Hogar</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Libros</a></li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="my-4">
                    <h3>Gestionar Productos</h3>
                    <form id="productForm">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="productName" placeholder="Ingresa el nombre del producto">
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="productDescription" placeholder="Ingresa una breve descripción">
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="productPrice" placeholder="Ingresa el precio">
                        </div>
                        <div class="d-grid gap-2 d-md-block">
                            <button type="submit" class="btn btn-success me-2">Añadir Producto</button>
                            <button type="button" class="btn btn-warning me-2">Editar Producto</button>
                            <button type="button" class="btn btn-danger">Eliminar Producto</button>
                        </div>
                    </form>
                </div>

                <!-- Contenedor de productos -->
                <div class="row">
                    <?php foreach ($productos as $producto): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="<?= $producto['image_url'] ?? 'https://via.placeholder.com/150' ?>" class="card-img-top" alt="<?= htmlspecialchars($producto['name']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($producto['name']) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($producto['description']) ?></p>
                                    <p class="card-text">Precio: $<?= htmlspecialchars($producto['price']) ?></p>
                                    <a href="#" class="btn btn-primary">Comprar</a>
                                    <a href="#" class="btn btn-secondary">Detalles</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>
        </div>
    </div>
</body>
</html>