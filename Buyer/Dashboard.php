<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    

  </head>
<body>
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
              <li><a class="dropdown-item" href="#">Food Supplies</a></li>
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>