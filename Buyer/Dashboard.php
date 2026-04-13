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
      <nav class="navbar navbar-expand-lg bg-body-tertiary py-2">
    <div class="container-fluid px-5">

      <a class="navbar-brand d-flex align-items-center gap-3" href="Dashboard.php">
          <img src="../Assets/Brew_Hub.png" alt="Brewhub Logo" style="width: 50px; height: 50px;">
          Brewhub</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="Home" href="#">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="productCategoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Product Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="productCategoriesDropdown">
              <li><a class="dropdown-item" href="#">Coffee & ingredients</a></li>
              <li><a class="dropdown-item" href="#">Cups & Packaging</a></li>
              <li><a class="dropdown-item" href="#">Equipments</a></li>
              <li><a class="dropdown-item" href="#">Pastry Ingredients</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="Home" href="#">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="Home" href="#">Cart</a>
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
        <div class="p-4 rounded-3 shadow-sm h-100 text-center text-white d-flex align-items-end justify-content-center coffee-ingredients-card">Coffee & ingredients</div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="p-4 rounded-3 shadow-sm h-100 text-center text-white d-flex align-items-end justify-content-center cups-card">Cups & Packaging</div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="p-4 rounded-3 shadow-sm h-100 text-center text-white d-flex align-items-end justify-content-center equipments-card">Equipments</div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="p-4 rounded-3 shadow-sm h-100 text-center text-white d-flex align-items-end justify-content-center pastries-card">Pastries& Ingredients</div>
      </div>
    </div>
  </div>

  <h3 class="text-center mt-5">Products</h3>   

  <div class="container-fluid px-5 pb-5 mt-4">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3 mb-3">
      <div class="col">
        <div class="card h-100 shadow-sm border-0"><div class="card-body">
          <img src="Assets/Arabica.png" alt="">
          <h6 class="card-title mb-0">Arabica</h6>
        </div>
      </div>
    </div>
      <div class="col">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <h6 class="card-title mb-0">Robusta</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <h6 class="card-title mb-0">Arabica + Robusta</h6>
          </div>
         </div>
        </div>
      <div class="col">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <h6 class="card-title mb-0">Barako</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm border-0 shop-coffee-card" style="--shop-coffee-card-height: 300px;">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>