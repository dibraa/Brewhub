<?php
declare(strict_types=1);
session_start();

// Initialize demo seller requests in session if not exists
if (!isset($_SESSION['demo_requests'])) {
	$_SESSION['demo_requests'] = [
		['id' => 1, 'username' => 'C. Garcia', 'email' => 'cgarcia@brewhub.com', 'shop_name' => 'BeanCraft Supplies', 'business_description' => 'Premium coffee beans supplier specializing in single-origin and specialty blends', 'status' => 'Pending', 'created_at' => '2024-04-18'],
		['id' => 2, 'username' => 'S. Dela Cruz', 'email' => 'sdelacruz@brewhub.com', 'shop_name' => 'Cup & Co.', 'business_description' => 'High-quality coffee cups, mugs, and accessories for coffee enthusiasts', 'status' => 'Pending', 'created_at' => '2024-04-16'],
		['id' => 3, 'username' => 'P. Navarro', 'email' => 'pnavarro@brewhub.com', 'shop_name' => 'GrindHouse Tools', 'business_description' => 'Professional coffee equipment and grinders for home and commercial use', 'status' => 'Pending', 'created_at' => '2024-04-14'],
		['id' => 4, 'username' => 'L. Torres', 'email' => 'ltorres@brewhub.com', 'shop_name' => 'Brew Masters', 'business_description' => 'Artisanal coffee roasting and brewing equipment', 'status' => 'Approved', 'created_at' => '2024-04-10'],
		['id' => 5, 'username' => 'R. Cruz', 'email' => 'rcruz@brewhub.com', 'shop_name' => 'Coffee Corner', 'business_description' => 'Local coffee shop supplies and ingredients', 'status' => 'Rejected', 'created_at' => '2024-04-08'],
	];
}

$message = '';

// Handle approve action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'approve' && isset($_POST['request_id'])) {
	$requestId = (int)$_POST['request_id'];
	$requests = $_SESSION['demo_requests'];
	$approved = false;
	
	foreach ($requests as &$request) {
		if ($request['id'] === $requestId) {
			$request['status'] = 'Approved';
			$approved = true;
			break;
		}
	}
	unset($request);
	
	if ($approved) {
		$_SESSION['demo_requests'] = $requests;
		$message = '<div class="alert alert-success">Seller request approved successfully!</div>';
	} else {
		$message = '<div class="alert alert-danger">Request not found.</div>';
	}
}

// Handle reject action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'reject' && isset($_POST['request_id'])) {
	$requestId = (int)$_POST['request_id'];
	$requests = $_SESSION['demo_requests'];
	$rejected = false;
	
	foreach ($requests as &$request) {
		if ($request['id'] === $requestId) {
			$request['status'] = 'Rejected';
			$rejected = true;
			break;
		}
	}
	unset($request);
	
	if ($rejected) {
		$_SESSION['demo_requests'] = $requests;
		$message = '<div class="alert alert-warning">Seller request rejected.</div>';
	} else {
		$message = '<div class="alert alert-danger">Request not found.</div>';
	}
}

// Handle delete action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['request_id'])) {
	$requestId = (int)$_POST['request_id'];
	$requests = $_SESSION['demo_requests'];
	$newRequests = [];
	$deleted = false;
	
	foreach ($requests as $request) {
		if ($request['id'] !== $requestId) {
			$newRequests[] = $request;
		} else {
			$deleted = true;
		}
	}
	
	if ($deleted) {
		$_SESSION['demo_requests'] = $newRequests;
		$message = '<div class="alert alert-success">Request deleted successfully!</div>';
	} else {
		$message = '<div class="alert alert-danger">Request not found.</div>';
	}
}

$requests = $_SESSION['demo_requests'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Seller Requests - Brewhub Admin</title>
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
			<a class="admin-sidebar-link active" href="SellerRequests.php">
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
		<section class="admin-dashboard py-4">
			<div class="container-fluid px-4 px-lg-5">
				<div class="admin-dashboard-header mb-4">
					<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
						<div>
							<h2 class="admin-dashboard-title mb-1">Seller Requests</h2>
							<p class="admin-dashboard-subtitle mb-0">Review and approve seller applications <span class="admin-pill">Demo Data</span></p>
						</div>
						<div class="d-flex gap-2">
							<div class="dropdown">
								<button class="btn btn-sm dropdown-toggle" type="button" id="filterStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background: rgba(255, 255, 255, 0.72); border: 1px solid rgba(111, 78, 55, 0.25); color: rgba(63, 41, 31, 0.92); font-weight: 600; border-radius: 10px; padding: 0.5rem 1rem;">
									<i class="bi bi-funnel me-1"></i><span id="filterStatusText">All Status</span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="filterStatusDropdown">
									<li><a class="dropdown-item" href="#" data-value="">All Status</a></li>
									<li><a class="dropdown-item" href="#" data-value="Pending">Pending</a></li>
									<li><a class="dropdown-item" href="#" data-value="Approved">Approved</a></li>
									<li><a class="dropdown-item" href="#" data-value="Rejected">Rejected</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<?php echo $message; ?>

				<div class="row">
					<div class="col-12">
						<div class="admin-section-card">
							<div class="admin-card-header">
								<div class="d-flex align-items-center gap-2">
									<span class="admin-card-icon"><i class="bi bi-shop"></i></span>
									<h3 class="admin-card-title mb-0">All Requests (<?php echo count($requests); ?>)</h3>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table table-sm align-middle admin-table mb-0" id="requestsTable">
									<thead>
										<tr>
											<th>ID</th>
											<th>Seller</th>
											<th>Email</th>
											<th>Shop Name</th>
											<th>Description</th>
											<th>Submitted</th>
											<th>Status</th>
											<th class="text-end">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($requests as $request): ?>
										<tr data-status="<?php echo htmlspecialchars($request['status']); ?>">
											<td class="fw-semibold">#<?php echo htmlspecialchars((string)$request['id']); ?></td>
											<td class="fw-semibold"><?php echo htmlspecialchars($request['username']); ?></td>
											<td class="text-muted"><?php echo htmlspecialchars($request['email']); ?></td>
											<td class="text-muted"><?php echo htmlspecialchars($request['shop_name']); ?></td>
											<td class="text-muted" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
												<?php echo htmlspecialchars($request['business_description']); ?>
											</td>
											<td class="text-muted"><?php echo date('M d, Y', strtotime($request['created_at'])); ?></td>
											<td>
												<span class="admin-status <?php echo strtolower($request['status']) === 'pending' ? 'admin-status-muted' : ''; ?>">
													<?php echo htmlspecialchars($request['status']); ?>
												</span>
											</td>
											<td class="text-end">
												<?php if (strtolower($request['status']) === 'pending'): ?>
												<form method="POST" style="display: inline;" onsubmit="return confirm('Approve this seller request?');">
													<input type="hidden" name="action" value="approve">
													<input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
													<button type="submit" class="btn admin-btn admin-btn-primary btn-sm">
														<i class="bi bi-check2-circle me-1"></i>Approve
													</button>
												</form>
												<form method="POST" style="display: inline;" onsubmit="return confirm('Reject this seller request?');">
													<input type="hidden" name="action" value="reject">
													<input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
													<button type="submit" class="btn admin-btn admin-btn-ghost btn-sm">
														<i class="bi bi-x-circle me-1"></i>Reject
													</button>
												</form>
												<?php endif; ?>
												<button type="button" class="btn admin-btn admin-btn-ghost btn-sm" onclick="viewRequest(<?php echo $request['id']; ?>)">
													<i class="bi bi-eye me-1"></i>View
												</button>
												<form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this request?');">
													<input type="hidden" name="action" value="delete">
													<input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
													<button type="submit" class="btn admin-btn admin-btn-danger btn-sm">
														<i class="bi bi-trash3 me-1"></i>Remove
													</button>
												</form>
											</td>
										</tr>
										<?php endforeach; ?>
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
		const body = document.body;

		sidebarToggle.addEventListener('click', () => {
			body.classList.toggle('admin-sidebar-collapsed');
		});

		// Filter by status using dropdown
		const filterDropdownItems = document.querySelectorAll('#filterStatusDropdown + .dropdown-menu .dropdown-item');
		const filterStatusText = document.getElementById('filterStatusText');
		let currentFilter = '';

		filterDropdownItems.forEach(item => {
			item.addEventListener('click', function(e) {
				e.preventDefault();
				const filterValue = this.getAttribute('data-value').toLowerCase();
				const displayText = this.textContent;
				
				currentFilter = filterValue;
				filterStatusText.textContent = displayText;
				
				const rows = document.querySelectorAll('#requestsTable tbody tr');
				rows.forEach(row => {
					const status = row.getAttribute('data-status').toLowerCase();
					row.style.display = filterValue === '' || status === filterValue ? '' : 'none';
				});
			});
		});

		function viewRequest(requestId) {
			alert('View request details for ID: ' + requestId + '\n(Feature to be implemented)');
		}
	</script>
</body>
</html>
