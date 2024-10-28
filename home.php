<?php
session_start();
include 'ProductController.php';

$productController = new ProductController();
$products = $productController->getProducts();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Productos</title>
  <link href="home.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

  <!-- Barra de navegación -->
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

  <!-- Contenedor principal -->
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

      <!-- Contenido principal -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="my-4">
          <h3>Gestionar Productos</h3>
          
          <!-- Mostrar productos -->
          <div class="row">
            <?php foreach ($products as $product): ?>
              <div class="col-md-4 mb-4">
                <div class="card">
                  <img src="<?php echo $product['image_url'] ?? 'https://via.placeholder.com/150'; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                    <a href="details.php?slug=<?php echo urlencode($product['slug']); ?>" class="btn btn-secondary">Detalles</a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          
        </div>
      </main>
    </div>
  </div>

</body>
</html>
