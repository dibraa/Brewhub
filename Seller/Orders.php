<?php
session_start();

$orders = (array) ($_SESSION['seller_orders'] ?? []);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Seller Orders</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="../Style.css" rel="stylesheet">
</head>
<body class="dashboard-page d-flex flex-column min-vh-100">
	<nav class="navbar navbar-expand-md navbar-light fixed-top bh-navbar">
		<div class="container-fluid px-4 px-lg-5 bh-nav-container">
			<a class="navbar-brand bh-brand" href="../Buyer/Dashboard.php">Brewhub</a>

			<div class="d-flex align-items-center gap-2 order-md-3 bh-nav-actions">
				<span class="navbar-text" style="color: #8B4513; font-weight: 500;">
					<i class="bi bi-shop me-2"></i>Brewhub Beans Corner
				</span>
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
						<a class="nav-link active" aria-current="page" href="Orders.php">Orders</a>
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
					<h1 class="seller-dashboard-title mb-0">Orders</h1>
				</div>
			</div>

			<section class="seller-section-card mb-4">
				<h2 class="seller-section-heading mb-3"><i class="bi bi-bag-check me-2"></i>Orders</h2>
				<div class="table-responsive">
					<table class="table seller-table align-middle">
						<thead>
							<tr>
								<th>Order ID</th>
								<th>Customer</th>
								<th>Item</th>
								<th>Qty</th>
								<th style="width: 180px;">Status</th>
								<th style="width: 150px;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($orders as $order): ?>
								<tr>
									<td><?php echo htmlspecialchars((string) ($order['id'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo htmlspecialchars((string) ($order['customer'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo htmlspecialchars((string) ($order['item'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo (int) ($order['qty'] ?? 0); ?></td>
									<td>
										<select class="form-select seller-form-control">
											<option <?php echo ((string) ($order['status'] ?? '')) === 'Pending' ? 'selected' : ''; ?>>Pending</option>
											<option <?php echo ((string) ($order['status'] ?? '')) === 'Completed' ? 'selected' : ''; ?>>Completed</option>
										</select>
									</td>
									<td>
										<button type="button" class="btn btn-sm profile-btn profile-btn-edit"><i class="bi bi-arrow-repeat me-1"></i>Update</button>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</main>

	<footer class="bh-footer-bar px-4 px-lg-5 py-4 mt-auto">
		<div class="container-fluid bh-footer-bar-container">
			<div class="bh-footer-bar-left">
				<div class="bh-footer-bar-logo-box">
					<img src="../Assets/Brew_Hub.png" alt="Brewhub Logo" class="bh-footer-bar-logo">
				</div>

				<div class="bh-footer-bar-meta">
					<div class="bh-footer-bar-copy">&copy; 2026 Brewhub Seller</div>
					<div class="bh-footer-bar-legal" aria-label="Legal links">
						<a class="bh-footer-bar-legal-link" href="#">Terms</a>
						<a class="bh-footer-bar-legal-link" href="#">Privacy</a>
						<a class="bh-footer-bar-legal-link" href="#">Cookies</a>
					</div>
				</div>
			</div>

			<nav class="bh-footer-bar-nav" aria-label="Footer navigation">
				<a class="bh-footer-bar-link" href="SellerDashboard.php">Dashboard</a>
				<a class="bh-footer-bar-link" href="Products.php">Products</a>
				<a class="bh-footer-bar-link" href="Orders.php">Orders</a>
				<a class="bh-footer-bar-link" href="ShopProfile.php">Shop Profile</a>
			</nav>
		</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
