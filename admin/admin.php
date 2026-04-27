<?php
declare(strict_types=1);

session_start();

$usersRaw = $_SESSION['bh_users'] ?? [];
$productsRaw = $_SESSION['bh_products'] ?? [];
$requestsRaw = $_SESSION['bh_seller_requests'] ?? [];

$usersRaw = is_array($usersRaw) ? array_values($usersRaw) : [];
$productsRaw = is_array($productsRaw) ? array_values($productsRaw) : [];
$requestsRaw = is_array($requestsRaw) ? array_values($requestsRaw) : [];

$totalUsers = 0;
$totalSellers = 0;
$recentUsers = [];
foreach ($usersRaw as $u) {
	if (!is_array($u)) {
		continue;
	}
	$id = (int) ($u['id'] ?? $u['ID'] ?? 0);
	if ($id <= 0) {
		continue;
	}
	$totalUsers++;
	$role = strtolower((string) ($u['role'] ?? ''));
	if ($role === 'seller') {
		$totalSellers++;
	}
	$recentUsers[] = [
		'id' => $id,
		'name' => (string) ($u['username'] ?? $u['name'] ?? ''),
		'email' => (string) ($u['email'] ?? ''),
		'role' => (string) ($u['role'] ?? ''),
		'status' => (string) ($u['status'] ?? 'Active'),
	];
}

$totalProducts = 0;
foreach ($productsRaw as $p) {
	if (!is_array($p)) {
		continue;
	}
	$id = (int) ($p['id'] ?? 0);
	if ($id <= 0) {
		continue;
	}
	$totalProducts++;
}

$pendingRequests = 0;
$recentRequests = [];
foreach ($requestsRaw as $r) {
	if (!is_array($r)) {
		continue;
	}
	$id = (int) ($r['id'] ?? $r['request_id'] ?? 0);
	if ($id <= 0) {
		continue;
	}
	$status = strtolower((string) ($r['status'] ?? 'Pending'));
	if ($status === 'pending') {
		$pendingRequests++;
	}
	$recentRequests[] = [
		'id' => $id,
		'seller' => (string) ($r['username'] ?? $r['seller'] ?? $r['name'] ?? ''),
		'shop' => (string) ($r['shop_name'] ?? $r['shop'] ?? ''),
		'created_at' => (string) ($r['created_at'] ?? ''),
		'status' => (string) ($r['status'] ?? 'Pending'),
	];
}

$recentUsers = array_slice(array_reverse($recentUsers), 0, 3);
$recentRequests = array_slice(array_reverse($recentRequests), 0, 3);

$finalTotals = [
	'total_users' => (int) $totalUsers,
	'total_sellers' => (int) $totalSellers,
	'total_products' => (int) $totalProducts,
	'pending_requests' => (int) $pendingRequests,
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Brewhub Admin Dashboard</title>
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
			<a class="admin-sidebar-link active" href="admin.php">
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
			<a class="admin-sidebar-link" href="Products.php">
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
					<div class="d-flex align-items-center gap-3 flex-wrap">
						<h2 class="admin-dashboard-title mb-1">Dashboard</h2>
					</div>
				</div>

            <!--data is temporary-->
				<div class="row g-3 admin-stats-row mb-4">
					<div class="col-12 col-sm-6 col-lg-3">
						<div class="admin-stat-card">
							<span class="admin-stat-icon"><i class="bi bi-people"></i></span>
							<div>
								<div class="admin-stat-label">Total Users</div>
								<div class="admin-stat-value"><?php echo number_format((int) $finalTotals['total_users']); ?></div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-lg-3">
						<div class="admin-stat-card">
							<span class="admin-stat-icon"><i class="bi bi-shop"></i></span>
							<div>
								<div class="admin-stat-label">Total Sellers</div>
								<div class="admin-stat-value"><?php echo number_format((int) $finalTotals['total_sellers']); ?></div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-lg-3">
						<div class="admin-stat-card">
							<span class="admin-stat-icon"><i class="bi bi-box-seam"></i></span>
							<div>
								<div class="admin-stat-label">Total Products</div>
								<div class="admin-stat-value"><?php echo number_format((int) $finalTotals['total_products']); ?></div>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-lg-3">
						<div class="admin-stat-card">
							<span class="admin-stat-icon"><i class="bi bi-inbox"></i></span>
							<div>
								<div class="admin-stat-label">Pending Requests</div>
								<div class="admin-stat-value"><?php echo number_format((int) $finalTotals['pending_requests']); ?></div>
							</div>
						</div>
					</div>
				</div>

				<div class="row g-4">
					<div class="col-12" id="user-management">
						<div class="admin-section-card h-100">
							<div class="admin-card-header">
								<div class="d-flex align-items-center gap-2">
									<span class="admin-card-icon"><i class="bi bi-people"></i></span>
									<h3 class="admin-card-title mb-0">User Management</h3>
								</div>
								<a class="admin-card-link" href="UserManagement.php">View all</a>
							</div>
							<div class="table-responsive">
								<table class="table table-sm align-middle admin-table mb-0">
									<thead>
										<tr>
											<th>User</th>
											<th>Email</th>
											<th>Role</th>
											<th>Status</th>
											<th class="text-end">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php if (count($recentUsers) === 0): ?>
											<tr>
												<td colspan="5" class="text-muted text-center py-4">No users found.</td>
											</tr>
										<?php else: ?>
											<?php foreach ($recentUsers as $u): ?>
												<?php
													$name = (string) ($u['name'] ?? '');
													$email = (string) ($u['email'] ?? '');
													$role = (string) ($u['role'] ?? '');
													$status = (string) ($u['status'] ?? 'Active');
												?>
												<tr>
													<td class="fw-semibold"><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></td>
													<td class="text-muted"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></td>
													<td><span class="admin-badge"><?php echo htmlspecialchars($role, ENT_QUOTES, 'UTF-8'); ?></span></td>
													<td><span class="admin-status <?php echo strtolower($status) === 'pending' ? 'admin-status-muted' : ''; ?>"><?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?></span></td>
													<td class="text-end">
														<a class="btn admin-btn admin-btn-ghost btn-sm" href="UserManagement.php"><i class="bi bi-eye me-1"></i>View</a>
													</td>
												</tr>
											<?php endforeach; ?>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="col-12" id="seller-requests">
						<div class="admin-section-card h-100">
							<div class="admin-card-header">
								<div class="d-flex align-items-center gap-2">
									<span class="admin-card-icon"><i class="bi bi-shop"></i></span>
									<h3 class="admin-card-title mb-0">Seller Requests</h3>
								</div>
								<a class="admin-card-link" href="SellerRequests.php">Review queue</a>
							</div>
							<div class="table-responsive">
								<table class="table table-sm align-middle admin-table mb-0">
									<thead>
										<tr>
											<th>Seller</th>
											<th>Shop</th>
											<th>Submitted</th>
											<th>Status</th>
											<th class="text-end">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php if (count($recentRequests) === 0): ?>
											<tr>
												<td colspan="5" class="text-muted text-center py-4">No seller requests found.</td>
											</tr>
										<?php else: ?>
											<?php foreach ($recentRequests as $r): ?>
												<?php
													$seller = (string) ($r['seller'] ?? '');
													$shop = (string) ($r['shop'] ?? '');
													$status = (string) ($r['status'] ?? 'Pending');
													$submitted = (string) ($r['created_at'] ?? '');
													$submittedShort = $submitted !== '' ? date('M d', strtotime($submitted)) : '-';
												?>
												<tr>
													<td class="fw-semibold"><?php echo htmlspecialchars($seller, ENT_QUOTES, 'UTF-8'); ?></td>
													<td class="text-muted"><?php echo htmlspecialchars($shop, ENT_QUOTES, 'UTF-8'); ?></td>
													<td class="text-muted"><?php echo htmlspecialchars($submittedShort, ENT_QUOTES, 'UTF-8'); ?></td>
													<td><span class="admin-status <?php echo strtolower($status) === 'pending' ? 'admin-status-muted' : ''; ?>"><?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?></span></td>
													<td class="text-end">
														<a class="btn admin-btn admin-btn-ghost btn-sm" href="SellerRequests.php"><i class="bi bi-eye me-1"></i>View</a>
													</td>
												</tr>
											<?php endforeach; ?>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

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
		const adminSidebar = document.getElementById('adminSidebar');
		const body = document.body;

		sidebarToggle.addEventListener('click', () => {
			body.classList.toggle('admin-sidebar-collapsed');
		});
	</script>
</body>
</html>
