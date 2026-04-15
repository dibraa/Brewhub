<?php
// Temporary demo data for seller orders page.
// Replace these with database values once backend is ready.
$orders = [
	['id' => 'ORD-1021', 'customer' => 'Mia Santos', 'item' => 'Arabica Beans', 'qty' => 2, 'status' => 'Pending'],
	['id' => 'ORD-1022', 'customer' => 'Kyle Reyes', 'item' => 'Robusta Beans', 'qty' => 1, 'status' => 'Completed'],
	['id' => 'ORD-1023', 'customer' => 'Lea Cruz', 'item' => 'Barako Beans', 'qty' => 3, 'status' => 'Pending'],
];
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
									<td><?php echo htmlspecialchars($order['id'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo htmlspecialchars($order['customer'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo htmlspecialchars($order['item'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?php echo (int) $order['qty']; ?></td>
									<td>
										<select class="form-select seller-form-control">
											<option <?php echo $order['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
											<option <?php echo $order['status'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
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
							<a class="nav-link active" aria-current="page" href="Orders.php">Orders</a>
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
