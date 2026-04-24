<?php
// Temporary demo data for seller dashboard.
// Replace these with database values once backend is ready.
$totalSales = 18540.75;
$totalOrders = 42;
$totalProducts = 12;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Seller Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="../Style.css" rel="stylesheet">
</head>
<body class="dashboard-page">
	<nav class="navbar navbar-expand-md navbar-light fixed-top bh-navbar">
		<div class="container-fluid px-4 px-lg-5 bh-nav-container">
			<a class="navbar-brand bh-brand" href="../Buyer/Dashboard.php">Brewhub</a>

			<div class="d-flex align-items-center gap-2 order-md-3 bh-nav-actions">
			
			</div>

			<div class="collapse navbar-collapse justify-content-center order-md-2" id="navbarNav">
				<ul class="navbar-nav align-items-md-center gap-md-4 gap-lg-5 bh-nav-links">
					<li class="nav-item">
						<a class="nav-link active" href="SellerDashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="Products.php">Products</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="Orders.php">Orders</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="ShopProfile.php">Shop Profile</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<main class="seller-dashboard-main py-4 py-lg-5">
		<div class="container seller-dashboard-container">
			<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
				<div>
					<p class="profile-kicker mb-2"><i class="bi bi-shop me-2"></i>Seller Center</p>
					<h1 class="seller-dashboard-title mb-0">Seller Dashboard</h1>
				</div>
			</div>

			<section id="overview" class="mb-4">
				<div class="row g-3">
					<div class="col-12 col-md-4">
						<div class="seller-stat-card h-100">
							<div class="seller-stat-icon"><i class="bi bi-cash-coin"></i></div>
							<p class="seller-stat-label mb-1">Total Sales</p>
							<h3 class="seller-stat-value mb-0">PHP <?php echo number_format($totalSales, 2); ?></h3>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="seller-stat-card h-100">
							<div class="seller-stat-icon"><i class="bi bi-receipt"></i></div>
							<p class="seller-stat-label mb-1">Total Orders</p>
							<h3 class="seller-stat-value mb-0"><?php echo (int) $totalOrders; ?></h3>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="seller-stat-card h-100">
							<div class="seller-stat-icon"><i class="bi bi-box-seam"></i></div>
							<p class="seller-stat-label mb-1">Total Products</p>
							<h3 class="seller-stat-value mb-0"><?php echo (int) $totalProducts; ?></h3>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>

	<footer class="bh-footer seller-footer py-5 px-4 px-lg-5 mt-5">
		<div class="container-fluid bh-footer-container">
			<div class="row g-4 g-lg-5">
				<div class="col-12 col-md-3 text-center text-md-start">
					<a class="bh-footer-brand" href="SellerDashboard.php">Brewhub</a>
					<img src="../Assets/Brew_Hub.png" alt="Brewhub Logo" class="bh-footer-logo mt-3 mx-auto mx-md-0">
				</div>
				<div class="col-12 col-md-9 text-center text-md-start">
					<h4 class="bh-footer-heading mb-3 text-center text-md-start">Menu</h4>
					<ul class="navbar-nav flex-column flex-sm-row flex-wrap justify-content-center justify-content-md-start align-items-center gap-2 gap-md-4 gap-lg-5 bh-nav-links seller-footer-links">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="SellerDashboard.php">Dashboard</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="Products.php">Products</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="Orders.php">Orders</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="ShopProfile.php">Shop Profile</a>
						</li>
					</ul>
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
