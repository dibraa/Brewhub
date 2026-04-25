<?php
declare(strict_types=1);

session_start();

function bh_demo_products_seed(): array
{
	return [
		[
			'id' => 101,
			'name' => 'Arabica Beans (1kg)',
			'category' => 'Coffee & Ingredients',
			'price' => 549.00,
			'image' => '../Assets/Arabica.png',
		],
		[
			'id' => 102,
			'name' => 'Robusta Beans (1kg)',
			'category' => 'Coffee & Ingredients',
			'price' => 499.00,
			'image' => '../Assets/Robusta.png',
		],
		[
			'id' => 103,
			'name' => 'Coffee Cups Pack',
			'category' => 'Cups & Packaging',
			'price' => 129.00,
			'image' => '../Assets/Cups.png',
		],
		[
			'id' => 104,
			'name' => 'Brewing Equipment Set',
			'category' => 'Equipments',
			'price' => 1499.00,
			'image' => '../Assets/Equipment.png',
		],
		[
			'id' => 105,
			'name' => 'Pastry Box Bundle',
			'category' => 'Pastry',
			'price' => 219.00,
			'image' => '../Assets/pastries.png',
		],
	];
}

if (!isset($_SESSION['bh_admin_demo_products']) || !is_array($_SESSION['bh_admin_demo_products'])) {
	$_SESSION['bh_admin_demo_products'] = bh_demo_products_seed();
}

$flash = null;

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
	$action = (string) ($_POST['action'] ?? '');
	if ($action === 'delete') {
		$productId = (int) ($_POST['product_id'] ?? 0);

		$products = (array) $_SESSION['bh_admin_demo_products'];
		$beforeCount = count($products);
		$products = array_values(array_filter($products, static fn($p) => (int) ($p['id'] ?? 0) !== $productId));
		$_SESSION['bh_admin_demo_products'] = $products;

		$afterCount = count($products);
		$flash = ($afterCount < $beforeCount)
			? 'Product deleted (demo).'
			: 'Product not found.';
	}
}

$products = (array) $_SESSION['bh_admin_demo_products'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Brewhub Admin Products</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="../Style.css?v=20260420" rel="stylesheet">
</head>

<body class="admin-page admin-sidebar-layout">
	<nav class="admin-topbar">
		<div class="admin-topbar-container">
			<button class="admin-sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
				<i class="bi bi-list"></i>
			</button>
			<a class="admin-topbar-brand" href="admin.php">Brewhub Admin</a>
			<div class="admin-topbar-actions">
				<a class="btn bh-icon-btn position-relative" href="#" aria-label="Notifications">
					<i class="bi bi-bell"></i>
					<span class="bh-cart-count" aria-hidden="true">3</span>
				</a>
				<a class="btn bh-icon-btn" href="#" aria-label="Settings">
					<i class="bi bi-gear"></i>
				</a>
			</div>
		</div>
	</nav>

	<aside class="admin-sidebar" id="adminSidebar">
		<div class="admin-sidebar-header">
			<a class="admin-sidebar-brand" href="admin.php">Brewhub</a>
		</div>
		<nav class="admin-sidebar-nav">
			<a class="admin-sidebar-link" href="admin.php">
				<i class="bi bi-speedometer2"></i>
				<span>Dashboard</span>
			</a>
			<a class="admin-sidebar-link" href="UserManagement.php">
				<i class="bi bi-people"></i>
				<span>User Management</span>
			</a>
			<a class="admin-sidebar-link" href="SellerRequests.php">
				<i class="bi bi-shop"></i>
				<span>Seller Requests</span>
			</a>
			<a class="admin-sidebar-link active" href="Products.php">
				<i class="bi bi-box-seam"></i>
				<span>Products</span>
			</a>
		</nav>
		<div class="admin-sidebar-footer">
			<a class="admin-sidebar-logout" href="../Login.php">
				<i class="bi bi-box-arrow-right"></i>
				<span>Logout</span>
			</a>
		</div>
	</aside>

	<main class="admin-main admin-main-with-sidebar">
		<section class="admin-dashboard py-5">
			<div class="container-fluid px-4 px-lg-5">
				<div class="admin-dashboard-header mb-4">
					<div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
						<div>
							<h2 class="admin-dashboard-title mb-1">Products</h2>
							<div class="text-muted">Temporary demo data (acts like database results).</div>
						</div>
						<a class="btn admin-btn admin-btn-ghost btn-sm" href="admin.php"><i class="bi bi-arrow-left me-1"></i>Back</a>
					</div>
				</div>

				<?php if ($flash): ?>
					<div class="alert alert-warning border-0" role="alert">
						<?php echo htmlspecialchars($flash, ENT_QUOTES, 'UTF-8'); ?>
					</div>
				<?php endif; ?>

				<div class="row g-4 admin-products-grid">
					<?php if (count($products) === 0): ?>
						<div class="col-12">
							<div class="admin-section-card">
								<div class="d-flex align-items-center gap-2">
									<span class="admin-card-icon"><i class="bi bi-inbox"></i></span>
									<div>
										<div class="fw-bold">No products found</div>
										<div class="text-muted">Add products to your database later — this page will show them here.</div>
									</div>
								</div>
							</div>
						</div>
					<?php else: ?>
						<?php foreach ($products as $p): ?>
							<?php
								$id = (int) ($p['id'] ?? 0);
								$name = (string) ($p['name'] ?? '');
								$category = (string) ($p['category'] ?? '');
								$price = (float) ($p['price'] ?? 0);
								$image = (string) ($p['image'] ?? '../Assets/Carousel.png');
							?>

							<div class="col-12 col-sm-6 col-lg-4">
								<div class="admin-section-card admin-product-card h-100">
									<div class="admin-product-media">
										<img class="admin-product-img" src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
									</div>
									<div class="admin-product-body">
										<div class="d-flex align-items-start justify-content-between gap-2">
											<h3 class="admin-product-name"><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></h3>
											<div class="admin-product-price">₱<?php echo number_format($price, 2); ?></div>
										</div>
										<div class="admin-product-meta">
											<span class="admin-badge"><?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?></span>
										</div>
										<div class="admin-product-actions">
											<form method="post" class="m-0" onsubmit="return confirm('Delete this product?');">
												<input type="hidden" name="action" value="delete">
												<input type="hidden" name="product_id" value="<?php echo $id; ?>">
												<button type="submit" class="btn admin-btn admin-btn-danger btn-sm"><i class="bi bi-trash3 me-1"></i>Delete</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</section>
	</main>

	<footer class="bh-footer-bar px-4 px-lg-5 py-4 mt-5">
		<div class="container-fluid bh-footer-bar-container">
			<div class="bh-footer-bar-left">
				<div class="bh-footer-bar-logo-box">
					<img src="../Assets/Brew_Hub.png" alt="Brewhub Logo" class="bh-footer-bar-logo">
				</div>

				<div class="bh-footer-bar-meta">
					<div class="bh-footer-bar-copy">&copy; 2026 Brewhub Admin</div>
					<div class="bh-footer-bar-legal" aria-label="Legal links">
						<a class="bh-footer-bar-legal-link" href="#">Terms</a>
						<a class="bh-footer-bar-legal-link" href="#">Privacy</a>
						<a class="bh-footer-bar-legal-link" href="#">Cookies</a>
					</div>
				</div>
			</div>

			<nav class="bh-footer-bar-nav" aria-label="Footer navigation">
				<a class="bh-footer-bar-link" href="admin.php">Dashboard</a>
				<a class="bh-footer-bar-link" href="UserManagement.php">User Management</a>
				<a class="bh-footer-bar-link" href="SellerRequests.php">Seller Requests</a>
				<a class="bh-footer-bar-link" href="Products.php">Products</a>
			</nav>
		</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script>
		const sidebarToggle = document.getElementById('sidebarToggle');
		const body = document.body;

		sidebarToggle.addEventListener('click', () => {
			body.classList.toggle('admin-sidebar-collapsed');
		});
	</script>
</body>
</html>
