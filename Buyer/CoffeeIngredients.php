<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coffee & Ingredients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../Style.css" rel="stylesheet">

  </head>
<body class="dashboard-page">
  <nav class="navbar navbar-expand-md navbar-light fixed-top bh-navbar">
    <div class="container-fluid px-4 px-lg-5 bh-nav-container">
      <a class="navbar-brand bh-brand" href="Dashboard.php">Brewhub</a>

      <div class="d-flex align-items-center gap-2 order-md-3 bh-nav-actions">
        <a class="btn bh-icon-btn" href="../Profile.php" aria-label="Profile">
          <i class="bi bi-person"></i>
        </a>
        <a class="btn bh-icon-btn position-relative" href="#" aria-label="Cart">
          <i class="bi bi-bag"></i>
          <span class="bh-cart-count">2</span>
        </a>
        <button class="navbar-toggler border-0 shadow-none p-0 ms-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>

      <div class="collapse navbar-collapse justify-content-center order-md-2" id="navbarNav">
        <ul class="navbar-nav align-items-md-center gap-md-4 gap-lg-5 bh-nav-links">
          <li class="nav-item">
            <a class="nav-link" href="Dashboard.php">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="productCategoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Product Categories</a>
            <ul class="dropdown-menu" aria-labelledby="productCategoriesDropdown">
              <li><a class="dropdown-item active" aria-current="page" href="CoffeeIngredients.php">Coffee &amp; Ingredients</a></li>
              <li><a class="dropdown-item" href="CupsPackaging.php">Cups &amp; Packaging</a></li>
              <li><a class="dropdown-item" href="Equipments.php">Equipments</a></li>
              <li><a class="dropdown-item" href="Pastry.php">Pastry</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="dashboard-main">
    <section class="dashboard-hero">
      <div class="dashboard-hero-overlay"></div>
      <div class="container-fluid px-5 py-5 position-relative">
        <div class="dashboard-hero-content">
          <p class="hero-kicker mb-2">Product Category</p>
          <h1 class="display-5 fw-semibold mb-3">Coffee &amp; Ingredients</h1>
          <p class="lead mb-0">Browse beans, syrups, milks, and ingredients for your cafe.</p>
        </div>
      </div>
    </section>

    <div class="container-fluid px-5 pb-5 mt-4 products-grid">
      <h3 class="text-center mt-5">Coffee &amp; Ingredients</h3>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3 mt-3">
        <div class="col">
          <div class="card h-100 shadow-sm reference-product-card">
            <div class="reference-product-image-wrap">
              <img src="../Assets/Arabica.png" alt="Arabica" style="width: 65%; height: auto; object-fit: cover; display: block; margin: 0 auto;">
            </div>
            <div class="card-body reference-product-body">
              <h5 class="reference-product-title mb-1">Arabica</h5>
              <h6 class="reference-product-seller mb-2">Seller name</h6>
              <h5 class="reference-product-price mb-0">₱960.00</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 shadow-sm reference-product-card">
            <div class="reference-product-image-wrap">
              <img src="../Assets/Robusta.png" alt="Robusta" style="width: 65%; height: auto; object-fit: cover; display: block; margin: 0 auto;">
            </div>
            <div class="card-body reference-product-body">
              <h5 class="reference-product-title mb-1">Robusta</h5>
              <h6 class="reference-product-seller mb-2">Seller name</h6>
              <h5 class="reference-product-price mb-0">₱299.00</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 shadow-sm reference-product-card">
            <div class="reference-product-image-wrap">
              <img src="../Assets/Barako.png" alt="Barako" style="width: 65%; height: auto; object-fit: cover; display: block; margin: 0 auto;">
            </div>
            <div class="card-body reference-product-body">
              <h5 class="reference-product-title mb-1">Barako</h5>
              <h6 class="reference-product-seller mb-2">Seller name</h6>
              <h5 class="reference-product-price mb-0">₱295.00</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="bh-footer py-5 px-4 px-lg-5 mt-5">
    <div class="container-fluid bh-footer-container">
      <div class="row g-4 g-lg-5">
        <div class="col-12 col-md-3">
          <a class="bh-footer-brand" href="Dashboard.php">Brewhub</a>
          <img src ="../Assets/Brew_Hub.png" alt="Brewhub Logo" class="bh-footer-logo mt-3">
        </div>
        <div class="col-6 col-md-3 d-flex flex-column gap-3">
          <h4 class="bh-footer-heading mb-0">Shop</h4>
          <a class="bh-footer-link" href="CoffeeIngredients.php">All Coffee</a>
          <a class="bh-footer-link" href="Equipments.php">Equipment</a>
          <a class="bh-footer-link" href="CupsPackaging.php">Cups &amp; Packaging</a>
          <a class="bh-footer-link" href="Pastry.php">Pastry</a>
        </div>

        <div class="col-6 col-md-3 d-flex flex-column gap-3">
          <h4 class="bh-footer-heading mb-0">Experience</h4>
          <a class="bh-footer-link" href="#">Brew Guides</a>
          <a class="bh-footer-link" href="#">Journal</a>
          <a class="bh-footer-link" href="#">Wholesale</a>
        </div>

        <div class="col-6 col-md-3 d-flex flex-column gap-3">
          <h4 class="bh-footer-heading mb-0">Legal</h4>
          <a class="bh-footer-link" href="#">Privacy Policy</a>
          <a class="bh-footer-link" href="#">Terms of Service</a>
          <a class="bh-footer-link" href="#">Shipping &amp; Returns</a>
        </div>
      </div>

      <div class="bh-footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-md-center mt-5 pt-4">
        <p class="bh-footer-copy mb-0">&copy; 2024 Brewhub Editorial. All rights reserved.</p>
        <div class="d-flex gap-3 mt-3 mt-md-0">
          <a class="bh-footer-social" href="#" aria-label="Share"><i class="bi bi-share"></i></a>
          <a class="bh-footer-social" href="#" aria-label="Language"><i class="bi bi-globe2"></i></a>
        </div>
      </div>
    </div>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
