<?php
declare(strict_types=1);
session_start();

// Initialize demo users in session if not exists
if (!isset($_SESSION['demo_users'])) {
	$_SESSION['demo_users'] = [
		['id' => 1, 'username' => 'Admin User', 'email' => 'admin@brewhub.com', 'role' => 'Admin', 'status' => 'Active', 'created_at' => '2024-01-01'],
		['id' => 2, 'username' => 'A. Santos', 'email' => 'asantos@brewhub.com', 'role' => 'Buyer', 'status' => 'Active', 'created_at' => '2024-01-15'],
		['id' => 3, 'username' => 'M. Reyes', 'email' => 'mreyes@brewhub.com', 'role' => 'Seller', 'status' => 'Pending', 'created_at' => '2024-02-20'],
		['id' => 4, 'username' => 'J. Lim', 'email' => 'jlim@brewhub.com', 'role' => 'Admin', 'status' => 'Active', 'created_at' => '2024-01-10'],
		['id' => 5, 'username' => 'C. Garcia', 'email' => 'cgarcia@brewhub.com', 'role' => 'Buyer', 'status' => 'Active', 'created_at' => '2024-03-05'],
		['id' => 6, 'username' => 'S. Dela Cruz', 'email' => 'sdelacruz@brewhub.com', 'role' => 'Buyer', 'status' => 'Active', 'created_at' => '2024-03-12'],
	];
}

$message = '';

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['user_id'])) {
	$userId = (int)$_POST['user_id'];
	$users = $_SESSION['demo_users'];
	$newUsers = [];
	$deleted = false;
	
	foreach ($users as $user) {
		if ($user['id'] !== $userId) {
			$newUsers[] = $user;
		} else {
			$deleted = true;
		}
	}
	
	if ($deleted) {
		$_SESSION['demo_users'] = $newUsers;
		$message = '<div class="alert alert-success">User deleted successfully!</div>';
	} else {
		$message = '<div class="alert alert-danger">User not found.</div>';
	}
}

$users = $_SESSION['demo_users'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Management - Brewhub Admin</title>
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
			<a class="admin-sidebar-link active" href="UserManagement.php">
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
		<section class="admin-dashboard py-4">
			<div class="container-fluid px-4 px-lg-5">
				<div class="admin-dashboard-header mb-4">
					<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
						<div>
							<h2 class="admin-dashboard-title mb-1">User Management</h2>
							<p class="admin-dashboard-subtitle mb-0">Manage all users in the system <span class="admin-pill">Demo Data</span></p>
						</div>
						<div class="d-flex gap-2">
							<input type="text" class="form-control" id="searchUsers" placeholder="Search users..." style="max-width: 250px;">
						</div>
					</div>
				</div>

				<?php echo $message; ?>

				<div class="row">
					<div class="col-12">
						<div class="admin-section-card">
							<div class="admin-card-header">
								<div class="d-flex align-items-center gap-2">
									<span class="admin-card-icon"><i class="bi bi-people"></i></span>
									<h3 class="admin-card-title mb-0">All Users (<?php echo count($users); ?>)</h3>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table table-sm align-middle admin-table mb-0" id="usersTable">
									<thead>
										<tr>
											<th>ID</th>
											<th>Username</th>
											<th>Email</th>
											<th>Role</th>
											<th>Status</th>
											<th>Joined</th>
											<th class="text-end">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($users as $user): ?>
										<tr>
											<td class="fw-semibold">#<?php echo htmlspecialchars((string)$user['id']); ?></td>
											<td class="fw-semibold"><?php echo htmlspecialchars($user['username']); ?></td>
											<td class="text-muted"><?php echo htmlspecialchars($user['email']); ?></td>
											<td><span class="admin-badge"><?php echo htmlspecialchars($user['role']); ?></span></td>
											<td>
												<span class="admin-status <?php echo strtolower($user['status']) === 'pending' ? 'admin-status-muted' : ''; ?>">
													<?php echo htmlspecialchars($user['status']); ?>
												</span>
											</td>
											<td class="text-muted"><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
											<td class="text-end">
												<button type="button" class="btn admin-btn admin-btn-ghost btn-sm" onclick="viewUser(<?php echo $user['id']; ?>)">
													<i class="bi bi-eye me-1"></i>View
												</button>
												<form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
													<input type="hidden" name="action" value="delete">
													<input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
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

		// Search functionality
		document.getElementById('searchUsers').addEventListener('keyup', function() {
			const searchValue = this.value.toLowerCase();
			const rows = document.querySelectorAll('#usersTable tbody tr');
			
			rows.forEach(row => {
				const text = row.textContent.toLowerCase();
				row.style.display = text.includes(searchValue) ? '' : 'none';
			});
		});

		function viewUser(userId) {
			alert('View user details for ID: ' + userId + '\n(Feature to be implemented)');
		}
	</script>
</body>
</html>
