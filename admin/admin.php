<?php
declare(strict_types=1);

function bh_env(string $key, string $default): string
{
	$value = getenv($key);
	if ($value === false || $value === '') {
		return $default;
	}
	return $value;
}

function bh_db_connect(): ?mysqli
{
	mysqli_report(MYSQLI_REPORT_OFF);

	$host = bh_env('BREWHUB_DB_HOST', '127.0.0.1');
	$user = bh_env('BREWHUB_DB_USER', 'root');
	$pass = bh_env('BREWHUB_DB_PASS', '');
	$name = bh_env('BREWHUB_DB_NAME', 'brewhub');
	$port = (int) bh_env('BREWHUB_DB_PORT', '3306');

	$db = @new mysqli($host, $user, $pass, $name, $port);
	if ($db && !$db->connect_errno) {
		@$db->set_charset('utf8mb4');
		return $db;
	}

	$unknownDb = $db && ($db->connect_errno === 1049);
	if ($unknownDb) {
		$serverOnly = @new mysqli($host, $user, $pass, '', $port);
		if ($serverOnly && !$serverOnly->connect_errno) {
			@$serverOnly->set_charset('utf8mb4');
			return $serverOnly;
		}
	}

	return null;
}

function bh_count_table(mysqli $db, string $table, ?string $whereSql = null): ?int
{
	$sql = "SELECT COUNT(*) AS c FROM `{$table}`";
	if ($whereSql) {
		$sql .= " WHERE {$whereSql}";
	}
	$result = @$db->query($sql);
	if (!$result) {
		return null;
	}
	$row = $result->fetch_assoc();
	$result->free();
	if (!$row || !isset($row['c'])) {
		return null;
	}
	return (int) $row['c'];
}

function bh_column_exists(mysqli $db, string $table, string $column): bool
{
	$result = @$db->query("SHOW COLUMNS FROM `{$table}` LIKE '" . $db->real_escape_string($column) . "'");
	if (!$result) {
		return false;
	}
	$exists = $result->num_rows > 0;
	$result->free();
	return $exists;
}

$db = bh_db_connect();

$demoTotals = [
	'total_users' => 124,
	'total_sellers' => 18,
	'total_products' => 392,
	'pending_requests' => 6,
];

$totals = [
	'total_users' => null,
	'total_sellers' => null,
	'total_products' => null,
	'pending_requests' => null,
];

$temporaryStats = true;

if ($db) {
	$totals['total_users'] = bh_count_table($db, 'users')
		?? bh_count_table($db, 'user')
		?? bh_count_table($db, 'accounts');

	$totals['total_products'] = bh_count_table($db, 'products')
		?? bh_count_table($db, 'product')
		?? bh_count_table($db, 'items');

	$totals['total_sellers'] = bh_count_table($db, 'sellers')
		?? bh_count_table($db, 'seller');

	if ($totals['total_sellers'] === null && $totals['total_users'] !== null && bh_column_exists($db, 'users', 'role')) {
		$totals['total_sellers'] = bh_count_table($db, 'users', "role IN ('seller','Seller')");
	}

	$totals['pending_requests'] = bh_count_table($db, 'seller_requests', "status IN ('pending','Pending')")
		?? bh_count_table($db, 'seller_request', "status IN ('pending','Pending')")
		?? bh_count_table($db, 'sellerrequests', "status IN ('pending','Pending')");

	$allLive = true;
	foreach ($totals as $v) {
		if ($v === null) {
			$allLive = false;
			break;
		}
	}

	if ($allLive) {
		$temporaryStats = false;
	} else {
		$demoQuery = @$db->query('SELECT 124 AS total_users, 18 AS total_sellers, 392 AS total_products, 6 AS pending_requests');
		if ($demoQuery) {
			$demoRow = $demoQuery->fetch_assoc();
			$demoQuery->free();
			if (is_array($demoRow)) {
				$demoTotals['total_users'] = (int) ($demoRow['total_users'] ?? $demoTotals['total_users']);
				$demoTotals['total_sellers'] = (int) ($demoRow['total_sellers'] ?? $demoTotals['total_sellers']);
				$demoTotals['total_products'] = (int) ($demoRow['total_products'] ?? $demoTotals['total_products']);
				$demoTotals['pending_requests'] = (int) ($demoRow['pending_requests'] ?? $demoTotals['pending_requests']);
			}
		}
	}
}

$finalTotals = [
	'total_users' => $totals['total_users'] ?? $demoTotals['total_users'],
	'total_sellers' => $totals['total_sellers'] ?? $demoTotals['total_sellers'],
	'total_products' => $totals['total_products'] ?? $demoTotals['total_products'],
	'pending_requests' => $totals['pending_requests'] ?? $demoTotals['pending_requests'],
];

if ($db) {
	@$db->close();
}
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

<body class="admin-page">
	<nav class="navbar navbar-expand-md navbar-light fixed-top bh-navbar">
		<div class="container-fluid px-4 px-lg-5 bh-nav-container">
			<a class="navbar-brand bh-brand" href="admin.php">Brewhub</a>

			<div class="d-flex align-items-center gap-2 order-md-3 bh-nav-actions">
				<a class="btn bh-icon-btn position-relative" href="#" aria-label="Notifications">
					<i class="bi bi-bell"></i>
					<span class="bh-cart-count" aria-hidden="true">3</span>
				</a>
				<a class="btn bh-icon-btn" href="#" aria-label="Settings">
					<i class="bi bi-gear"></i>
				</a>
				<a class="btn bh-icon-btn" href="../Profile.php" aria-label="Profile">
					<i class="bi bi-person"></i>
				</a>

				<button class="navbar-toggler border-0 shadow-none p-0 ms-1" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>

			<div class="collapse navbar-collapse justify-content-center order-md-2" id="adminNavbar">
				<ul class="navbar-nav align-items-md-center gap-md-4 gap-lg-5 bh-nav-links">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="admin.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#user-management">User Management</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#seller-requests">Seller Requests</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="Products.php">Products</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<main class="admin-main">
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
								<a class="admin-card-link" href="#">View all</a>
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
										<tr>
											<td class="fw-semibold">A. Santos</td>
											<td class="text-muted">asantos@brewhub.com</td>
											<td><span class="admin-badge">Buyer</span></td>
											<td><span class="admin-status">Active</span></td>
											<td class="text-end">
												<button type="button" class="btn admin-btn admin-btn-ghost btn-sm"><i class="bi bi-eye me-1"></i>View</button>
												<button type="button" class="btn admin-btn admin-btn-danger btn-sm"><i class="bi bi-trash3 me-1"></i>Remove</button>
											</td>
										</tr>
										<tr>
											<td class="fw-semibold">M. Reyes</td>
											<td class="text-muted">mreyes@brewhub.com</td>
											<td><span class="admin-badge">Seller</span></td>
											<td><span class="admin-status admin-status-muted">Pending</span></td>
											<td class="text-end">
												<button type="button" class="btn admin-btn admin-btn-ghost btn-sm"><i class="bi bi-eye me-1"></i>View</button>
												<button type="button" class="btn admin-btn admin-btn-danger btn-sm"><i class="bi bi-trash3 me-1"></i>Remove</button>
											</td>
										</tr>
										<tr>
											<td class="fw-semibold">J. Lim</td>
											<td class="text-muted">jlim@brewhub.com</td>
											<td><span class="admin-badge">Admin</span></td>
											<td><span class="admin-status">Active</span></td>
											<td class="text-end">
												<button type="button" class="btn admin-btn admin-btn-ghost btn-sm"><i class="bi bi-eye me-1"></i>View</button>
												<button type="button" class="btn admin-btn admin-btn-danger btn-sm"><i class="bi bi-trash3 me-1"></i>Remove</button>
											</td>
										</tr>
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
								<a class="admin-card-link" href="#">Review queue</a>
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
										<tr>
											<td class="fw-semibold">C. Garcia</td>
											<td class="text-muted">BeanCraft Supplies</td>
											<td class="text-muted">Apr 18</td>
											<td><span class="admin-status admin-status-muted">Pending</span></td>
											<td class="text-end">
												<button type="button" class="btn admin-btn admin-btn-primary btn-sm"><i class="bi bi-check2-circle me-1"></i>Approve</button>
												<button type="button" class="btn admin-btn admin-btn-ghost btn-sm"><i class="bi bi-eye me-1"></i>View</button>
												<button type="button" class="btn admin-btn admin-btn-danger btn-sm"><i class="bi bi-x-circle me-1"></i>Remove</button>
											</td>
										</tr>
										<tr>
											<td class="fw-semibold">S. Dela Cruz</td>
											<td class="text-muted">Cup & Co.</td>
											<td class="text-muted">Apr 16</td>
											<td><span class="admin-status admin-status-muted">Pending</span></td>
											<td class="text-end">
												<button type="button" class="btn admin-btn admin-btn-primary btn-sm"><i class="bi bi-check2-circle me-1"></i>Approve</button>
												<button type="button" class="btn admin-btn admin-btn-ghost btn-sm"><i class="bi bi-eye me-1"></i>View</button>
												<button type="button" class="btn admin-btn admin-btn-danger btn-sm"><i class="bi bi-x-circle me-1"></i>Remove</button>
											</td>
										</tr>
										<tr>
											<td class="fw-semibold">P. Navarro</td>
											<td class="text-muted">GrindHouse Tools</td>
											<td class="text-muted">Apr 14</td>
											<td><span class="admin-status admin-status-muted">Pending</span></td>
											<td class="text-end">
												<button type="button" class="btn admin-btn admin-btn-primary btn-sm"><i class="bi bi-check2-circle me-1"></i>Approve</button>
												<button type="button" class="btn admin-btn admin-btn-ghost btn-sm"><i class="bi bi-eye me-1"></i>View</button>
												<button type="button" class="btn admin-btn admin-btn-danger btn-sm"><i class="bi bi-x-circle me-1"></i>Remove</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="col-12" id="products">
						<div class="admin-section-card h-100">
							<div class="admin-card-header">
								<div class="d-flex align-items-center gap-2">
									<span class="admin-card-icon"><i class="bi bi-box-seam"></i></span>
									<h3 class="admin-card-title mb-0">Products</h3>
								</div>
								<a class="admin-card-link" href="Products.php">Manage</a>
							</div>
							<div class="d-flex flex-wrap gap-2">
								<a class="btn admin-btn admin-btn-primary btn-sm" href="Products.php"><i class="bi bi-grid-3x3-gap me-1"></i>Open Products</a>
								<a class="btn admin-btn admin-btn-ghost btn-sm" href="../Buyer/Dashboard.php"><i class="bi bi-box-arrow-up-right me-1"></i>View storefront</a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>
	</main>

	<footer class="bh-footer py-5 px-4 px-lg-5 mt-5">
		<div class="container-fluid bh-footer-container">
			<div class="row g-4 g-lg-5">
				<div class="col-12 col-md-3">
					<a class="bh-footer-brand" href="admin.php">Brewhub</a>
					<img src="../Assets/Brew_Hub.png" alt="Brewhub Logo" class="bh-footer-logo mt-3">
				</div>

				<div class="col-12 col-md-9 d-flex flex-wrap align-items-start justify-content-md-end gap-3 gap-md-4">
					<a class="bh-footer-link" href="admin.php">Dashboard</a>
					<a class="bh-footer-link" href="#user-management">User Management</a>
					<a class="bh-footer-link" href="#seller-requests">Seller Requests</a>
					<a class="bh-footer-link" href="Products.php">Products</a>
				</div>
			</div>

			<div class="bh-footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-md-center mt-5 pt-4">
				<p class="bh-footer-copy mb-0">&copy; 2026 Brewhub Admin. All rights reserved.</p>
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
