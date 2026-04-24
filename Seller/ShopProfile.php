<?php
session_start();

if (!isset($_SESSION['logout_token']) || !is_string($_SESSION['logout_token']) || $_SESSION['logout_token'] === '') {
	$_SESSION['logout_token'] = function_exists('random_bytes')
		? bin2hex(random_bytes(16))
		: hash('sha256', uniqid('', true));
}
$logoutToken = (string) $_SESSION['logout_token'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
	$postedToken = (string) ($_POST['logout_token'] ?? '');
	if (hash_equals($logoutToken, $postedToken)) {
		session_unset();
		session_destroy();
		header('Location: ../Login.php');
		exit;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shop Profile</title>
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
						<a class="nav-link" href="SellerDashboard.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="Products.php">Products</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="Orders.php">Orders</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="ShopProfile.php">Shop Profile</a>
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
					<h1 class="seller-dashboard-title mb-0">Shop Profile</h1>
				</div>
			</div>

			<section class="seller-section-card mb-4">
				<h2 class="seller-section-heading mb-3"><i class="bi bi-shop-window me-2"></i>Shop Profile</h2>
				<form action="#" method="post" class="row g-3">
					<input type="hidden" name="logout_token" value="<?php echo htmlspecialchars($logoutToken, ENT_QUOTES, 'UTF-8'); ?>">
					<div class="col-12 col-md-6">
						<label class="form-label seller-form-label" for="shopName">Shop Name</label>
						<input id="shopName" name="shop_name" type="text" class="form-control seller-form-control" value="Brewhub Beans Corner" required>
					</div>
					<div class="col-12 col-md-6">
						<label class="form-label seller-form-label" for="shopContact">Contact Info</label>
						<input id="shopContact" name="shop_contact" type="text" class="form-control seller-form-control" value="+63 917 222 1234" required>
					</div>
					<div class="col-12">
						<label class="form-label seller-form-label" for="shopDescription">Description</label>
						<textarea id="shopDescription" name="shop_description" rows="4" class="form-control seller-form-control" required>Small-batch roasted beans and cafe essentials for local coffee shops.</textarea>
					</div>
					<div class="col-12 d-flex flex-wrap gap-2">
						<button type="submit" class="btn profile-btn profile-btn-seller">
							<i class="bi bi-floppy me-2"></i>Save Shop Profile
						</button>
						<button type="submit" name="logout" value="1" formnovalidate class="btn btn-outline-danger">
							<i class="bi bi-box-arrow-right me-2"></i>Logout
						</button>
					</div>
				</form>
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
							<a class="nav-link" href="SellerDashboard.php">Dashboard</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="Products.php">Products</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="Orders.php">Orders</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="ShopProfile.php">Shop Profile</a>
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
