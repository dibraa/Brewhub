<?php
// Temporary demo data for seller dashboard.
// Replace these with database values once backend is ready.
$totalSales = 18540.75;
$totalOrders = 42;
$totalProducts = 12;

$products = [
	['name' => 'Arabica Beans', 'price' => 960.00, 'stock' => 24],
	['name' => 'Robusta Beans', 'price' => 299.00, 'stock' => 40],
	['name' => 'Barako Beans', 'price' => 295.00, 'stock' => 31],
];

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
	<title>Seller Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="Style.css" rel="stylesheet">
</head>
<body class="dashboard-page">
	<nav class="navbar navbar-expand-md navbar-light fixed-top bh-navbar">
		<div class="container-fluid px-4 px-lg-5 bh-nav-container">
			<a class="navbar-brand bh-brand" href="Buyer/Dashboard.php">Brewhub</a>

			<div class="d-flex align-items-center gap-2 order-md-3 bh-nav-actions">
			
			</div>

			<div class="collapse navbar-collapse justify-content-center order-md-2" id="navbarNav">
				<ul class="navbar-nav align-items-md-center gap-md-4 gap-lg-5 bh-nav-links">
					<li class="nav-item">
						<a class="nav-link active" href="#overview">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#products">Products</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#orders">Orders</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#shop-profile">Shop Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#settings">Settings</a>
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

			<section id="products" class="seller-section-card mb-4">
				<div class="d-flex justify-content-between align-items-center mb-3">
					<h2 class="seller-section-heading mb-0"><i class="bi bi-tags me-2"></i>Products</h2>
				</div>

				<form action="#" method="post" class="row g-3 mb-4">
					<div class="col-12 col-md-4">
						<label class="form-label seller-form-label" for="productName">Product Name</label>
						<input id="productName" name="product_name" type="text" class="form-control seller-form-control" required>
					</div>
					<div class="col-6 col-md-2">
						<label class="form-label seller-form-label" for="productPrice">Price</label>
						<input id="productPrice" name="product_price" type="number" step="0.01" min="0" class="form-control seller-form-control" required>
					</div>
					<div class="col-6 col-md-2">
						<label class="form-label seller-form-label" for="productStock">Stock</label>
						<input id="productStock" name="product_stock" type="number" min="0" class="form-control seller-form-control" required>
					</div>
					<div class="col-12 col-md-4 d-flex align-items-end">
						<button type="submit" class="btn profile-btn profile-btn-seller w-100"><i class="bi bi-plus-circle me-2"></i>Add Product</button>
					</div>
				</form>

				<div class="table-responsive">
					<table class="table seller-table align-middle">
						<thead>
							<tr>
								<th>Product</th>
								<th style="width: 130px;">Price</th>
								<th style="width: 120px;">Stock</th>
								<th style="width: 220px;">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($products as $product): ?>
								<tr>
									<td><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td>
										<input type="number" step="0.01" min="0" class="form-control seller-form-control" value="<?php echo number_format((float) $product['price'], 2, '.', ''); ?>">
									</td>
									<td>
										<input type="number" min="0" class="form-control seller-form-control" value="<?php echo (int) $product['stock']; ?>">
									</td>
									<td>
										<div class="d-flex gap-2">
											<button type="button" class="btn btn-sm profile-btn profile-btn-edit"><i class="bi bi-pencil-square me-1"></i>Edit</button>
											<button type="button" class="btn btn-sm seller-btn-delete"><i class="bi bi-trash me-1"></i>Delete</button>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</section>

			<section id="orders" class="seller-section-card mb-4">
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

			<section id="shop-profile" class="seller-section-card mb-4">
				<h2 class="seller-section-heading mb-3"><i class="bi bi-shop-window me-2"></i>Shop Profile</h2>
				<form action="#" method="post" class="row g-3">
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
					<div class="col-12">
						<button type="submit" class="btn profile-btn profile-btn-seller"><i class="bi bi-floppy me-2"></i>Save Shop Profile</button>
					</div>
				</form>
			</section>

			<section id="settings" class="seller-section-card mb-3">
				<h2 class="seller-section-heading mb-3"><i class="bi bi-gear me-2"></i>Settings</h2>
				<div class="row g-4">
					<div class="col-12 col-lg-8">
						<form action="#" method="post" class="row g-3">
							<div class="col-12 col-md-4">
								<label class="form-label seller-form-label" for="currentPassword">Current Password</label>
								<input id="currentPassword" type="password" class="form-control seller-form-control" required>
							</div>
							<div class="col-12 col-md-4">
								<label class="form-label seller-form-label" for="newPassword">New Password</label>
								<input id="newPassword" type="password" class="form-control seller-form-control" required>
							</div>
							<div class="col-12 col-md-4">
								<label class="form-label seller-form-label" for="confirmPassword">Confirm Password</label>
								<input id="confirmPassword" type="password" class="form-control seller-form-control" required>
							</div>
							<div class="col-12">
								<button type="submit" class="btn profile-btn profile-btn-edit"><i class="bi bi-key me-2"></i>Change Password</button>
							</div>
						</form>
					</div>
					<div class="col-12 col-lg-4 d-flex align-items-end justify-content-lg-end">
						<a class="btn seller-btn-logout" href="Login.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
					</div>
				</div>
			</section>
		</div>
	</main>

	<footer class="bh-footer py-5 px-4 px-lg-5 mt-5">
		<div class="container-fluid bh-footer-container">
			<div class="row g-4 g-lg-5">
				<div class="col-12 col-md-3">
					<a class="bh-footer-brand" href="#">Brewhub</a>
					<img src="Assets/Brew_Hub.png" alt="Brewhub Logo" class="bh-footer-logo mt-3">
				</div>
				<div class="col-6 col-md-3 d-flex flex-column gap-3">
					<h4 class="bh-footer-heading mb-0">Shop</h4>
					<a class="bh-footer-link" href="#">All Coffee</a>
					<a class="bh-footer-link" href="#">Equipment</a>
					<a class="bh-footer-link" href="#">Cups & Packaging</a>
					<a class="bh-footer-link" href="#">Pastries</a>
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
