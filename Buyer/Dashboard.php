<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
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
            <a class="nav-link active" aria-current="page" href="Dashboard.php">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="productCategoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Product Categories</a>
            <ul class="dropdown-menu" aria-labelledby="productCategoriesDropdown">
              <li><a class="dropdown-item" href="CoffeeIngredients.php">Coffee &amp; Ingredients</a></li>
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
          <p class="hero-kicker mb-2">Brewhub Marketplace</p>
          <h1 class="display-5 fw-semibold mb-3">Everything your coffee shop needs, all in one hub.</h1>
          <p class="lead mb-4">Discover premium beans, cups, milks, and equipment curated for busy cafes and small businesses.</p>
          <div class="d-flex flex-wrap gap-3">
            <a class="btn btn-light btn-lg px-4" href="#">Shop Supplies</a>
            <a class="btn btn-outline-light btn-lg px-4" href="#">View Deals</a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <h3 class="text-center mt-5">Explore our website</h3>

  <div class="container-fluid px-5 pb-5 mt-4">
    <div class="row g-3">
      <div class="col-12 col-sm-6 col-lg-3">
        <a href="CoffeeIngredients.php" class="p-4 rounded-3 shadow-sm h-100 text-center text-white d-flex align-items-end justify-content-center coffee-ingredients-card category-tile text-decoration-none">
          <span class="category-title">Coffee &amp; Ingredients</span>
          <span class="category-overlay">
            <span class="category-desc">Beans, syrups, milks, and ingredients.</span>
            <span class="category-shop-btn">Shop</span>
          </span>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <a href="CupsPackaging.php" class="p-4 rounded-3 shadow-sm h-100 text-center text-white d-flex align-items-end justify-content-center cups-card category-tile text-decoration-none">
          <span class="category-title">Cups &amp; Packaging</span>
          <span class="category-overlay">
            <span class="category-desc">Cups, lids, sleeves, and packaging.</span>
            <span class="category-shop-btn">Shop</span>
          </span>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <a href="Equipments.php" class="p-4 rounded-3 shadow-sm h-100 text-center text-white d-flex align-items-end justify-content-center equipments-card category-tile text-decoration-none">
          <span class="category-title">Equipments</span>
          <span class="category-overlay">
            <span class="category-desc">Machines, grinders, and cafe tools.</span>
            <span class="category-shop-btn">Shop</span>
          </span>
        </a>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <a href="Pastry.php" class="p-4 rounded-3 shadow-sm h-100 text-center text-white d-flex align-items-end justify-content-center pastries-card category-tile text-decoration-none">
          <span class="category-title">Pastry</span>
          <span class="category-overlay">
            <span class="category-desc">Pastries and baked goods for your menu.</span>
            <span class="category-shop-btn">Shop</span>
          </span>
        </a>
      </div>
    </div>
  </div>

  <h3 class="text-center mt-5">Products</h3>   

  <div class="container-fluid px-5 pb-5 mt-4 products-grid">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3 mb-3">
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
            <img src="../Assets/Robusta.png" alt="Arabica" style="width: 65%; height: auto; object-fit: cover; display: block; margin: 0 auto;">
          </div>
          <div class="card-body reference-product-body">
            <h5 class="reference-product-title mb-1">Rubosta</h5>
            <h6 class="reference-product-seller mb-2">Seller name</h6>
            <h5 class="reference-product-price mb-0">₱299.00</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100 shadow-sm reference-product-card">
          <div class="reference-product-image-wrap">
            <img src="../Assets/Arabica + robusta.png" alt="Arabica" style="width: 65%; height: auto; object-fit: cover; display: block; margin: 0 auto;">
          </div>
          <div class="card-body reference-product-body">
            <h5 class="reference-product-title mb-1">Arabika + Rubosta</h5>
            <h6 class="reference-product-seller mb-2">Seller name</h6>
            <h5 class="reference-product-price mb-0">₱350.00</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100 shadow-sm reference-product-card">
          <div class="reference-product-image-wrap">
            <img src="../Assets/Barako.png" alt="Arabica" style="width: 65%; height: auto; object-fit: cover; display: block; margin: 0 auto;">
          </div>
          <div class="card-body reference-product-body">
            <h5 class="reference-product-title mb-1">Barako</h5>
            <h6 class="reference-product-seller mb-2">Seller name</h6>
            <h5 class="reference-product-price mb-0">₱295.00</h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm border-0 shop-coffee-card" style="--shop-coffee-card-height: 280px;">
          <div class="card-body">
            <h6 class="card-title mb-0">Shop Coffee's</h6>
          </div>
        </div>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3 mb-3">
      <div class="col"><div class="card h-100 shadow-sm border-0"><div class="card-body"><h6 class="card-title mb-0">Single Wall Paper Cups</h6></div></div></div>
      <div class="col"><div class="card h-100 shadow-sm border-0"><div class="card-body"><h6 class="card-title mb-0">Double Wall Paper Cups</h6></div></div></div>
      <div class="col"><div class="card h-100 shadow-sm border-0"><div class="card-body"><h6 class="card-title mb-0">Ripple Wall Cups</h6></div></div></div>
      <div class="col"><div class="card h-100 shadow-sm border-0"><div class="card-body"><h6 class="card-title mb-0">PET Plastic Cups</h6></div></div></div>
      <div class="col"><div class="card h-100 shadow-sm border-0"><div class="card-body"><h6 class="card-title mb-0">Shop Cup's & Packaging</h6></div></div></div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">
      <div class="col"><div class="card h-100 shadow-sm border-0"><div class="card-body"><h6 class="card-title mb-0">Espresso Machine</h6></div></div></div>
      <div class="col"><div class="card h-100 shadow-sm border-0"><div class="card-body"><h6 class="card-title mb-0">Coffee Grinder</h6></div></div></div>
      <div class="col"><div class="card h-100 shadow-sm border-0"><div class="card-body"><h6 class="card-title mb-0">Drip Coffee Brewer</h6></div></div></div>
      <div class="col"><div class="card h-100 shadow-sm border-0"><div class="card-body"><h6 class="card-title mb-0">Commercial Blender</h6></div></div></div>
      <div class="col"><div class="card h-100 shadow-sm border-0"><div class="card-body"><h6 class="card-title mb-0">Shop Equipments</h6></div></div></div>
    </div>
  </div>

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
          <a class="bh-footer-link" href="#">Shipping & Returns</a>
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