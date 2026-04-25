<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Profile</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
		<link href="Style.css" rel="stylesheet">
</head>
<body class="dashboard-page">
	<nav class="navbar navbar-expand-md navbar-light fixed-top bh-navbar">
		<div class="container-fluid px-4 px-lg-5 bh-nav-container">
			<a class="navbar-brand bh-brand" href="Buyer/Dashboard.php">Brewhub</a>

			<div class="d-flex align-items-center gap-2 order-md-3 bh-nav-actions active">
				<a class="btn bh-icon-btn" href="Profile.php" aria-label="Profile">
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
						<a class="nav-link" aria-current="page" href="Buyer/Dashboard.php">Home</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="productCategoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Product Categories</a>
						<ul class="dropdown-menu" aria-labelledby="productCategoriesDropdown">
							<li><a class="dropdown-item" href="#">Coffee & Ingredients</a></li>
							<li><a class="dropdown-item" href="#">Cups & Packaging</a></li>
							<li><a class="dropdown-item" href="#">Equipments</a></li>
							<li><a class="dropdown-item" href="#">Pastry</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<main class="profile-page-main py-5">
		<div class="container profile-container">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-9 col-xl-8">
					<section class="card border-0 profile-card">
						<div class="card-body p-4 p-md-5">
							<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-3 mb-4">
								<div>
									<p class="profile-kicker mb-2"><i class="bi bi-cup-hot me-2"></i>Brewhub Account</p>
									<h1 class="profile-title h3 mb-0">My Profile</h1>
								</div>
							</div>

							<div class="profile-info-list mb-4">
								<div class="profile-info-item">
									<div class="profile-info-label"><i class="bi bi-at me-2"></i>Username</div>
									<div class="profile-info-value">@brewlover_07</div>
								</div>
								<div class="profile-info-item">
									<div class="profile-info-label"><i class="bi bi-person-vcard me-2"></i>Full Name</div>
									<div class="profile-info-value">Dave Nathaniel Pequero</div>
								</div>
								<div class="profile-info-item">
									<div class="profile-info-label"><i class="bi bi-envelope me-2"></i>Email Address</div>
									<div class="profile-info-value">Dib.peq@brewhub.com</div>
								</div>
							</div>

							<div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center gap-3">
								<div class="d-flex flex-column flex-sm-row gap-3">
									<a class="btn profile-btn profile-btn-edit" href="#"><i class="bi bi-pencil-square me-2"></i>Edit Profile</a>
									<a class="btn profile-btn profile-btn-seller" href="BecomeSeller.php?fullname=dib;email=dave%40brewhub.com"><i class="bi bi-shop me-2"></i>Become a Seller</a>
								</div>
								<a class="btn profile-btn profile-btn-edit" href="Login.php"><i class="bi bi-box-arrow-right me-2"></i>Log out</a>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</main>

	<footer class="bh-footer-bar px-4 px-lg-5 py-4 mt-5">
		<div class="container-fluid bh-footer-bar-container">
			<div class="bh-footer-bar-left">
				<div class="bh-footer-bar-logo-box">
					<img src="Assets/Brew_Hub.png" alt="Brewhub Logo" class="bh-footer-bar-logo">
				</div>

				<div class="bh-footer-bar-meta">
					<div class="bh-footer-bar-copy">&copy; 2026 Brewhub</div>
					<div class="bh-footer-bar-legal" aria-label="Legal links">
						<a class="bh-footer-bar-legal-link" href="#">Terms</a>
						<a class="bh-footer-bar-legal-link" href="#">Privacy</a>
						<a class="bh-footer-bar-legal-link" href="#">Cookies</a>
					</div>
				</div>
			</div>

			<nav class="bh-footer-bar-nav" aria-label="Footer navigation">
				<a class="bh-footer-bar-link" href="Buyer/Dashboard.php">Home</a>
				<a class="bh-footer-bar-link" href="Buyer/CoffeeIngredients.php">Coffee &amp; Ingredients</a>
				<a class="bh-footer-bar-link" href="Buyer/CupsPackaging.php">Cups &amp; Packaging</a>
				<a class="bh-footer-bar-link" href="Buyer/Equipments.php">Equipments</a>
				<a class="bh-footer-bar-link" href="Buyer/Pastry.php">Pastry</a>
			</nav>
		</div>
	</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
