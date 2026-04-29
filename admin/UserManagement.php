<?php
declare(strict_types=1);
session_start();

// Database connection
function bh_get_pdo(): ?PDO
{
	try {
		$pdo = new PDO(
			'mysql:host=localhost;dbname=brewhub;charset=utf8mb4',
			'root',
			'',
			[
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES => false,
			]
		);
		return $pdo;
	} catch (PDOException $e) {
		return null;
	}
}

function bh_fetch_users_from_db(): array
{
	$pdo = bh_get_pdo();
	if (!$pdo) {
		return [];
	}

	try {
		$stmt = $pdo->query("SELECT user_id AS id, userName AS username, fullName AS name, email, role, 'Active' as status, created_at FROM users ORDER BY user_id DESC");
		return $stmt->fetchAll();
	} catch (PDOException $e) {
		return [];
	}
}

function bh_delete_user_from_db(int $userId): bool
{
	$pdo = bh_get_pdo();
	if (!$pdo || $userId <= 0) {
		return false;
	}

	try {
		$stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
		return $stmt->execute([$userId]);
	} catch (PDOException $e) {
		return false;
	}
}

function bh_add_admin_to_db(string $username, string $name, string $email, string $password): bool
{
	$pdo = bh_get_pdo();
	if (!$pdo) {
		return false;
	}

	try {
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
		$stmt = $pdo->prepare("INSERT INTO users (userName, fullName, email, password, role) VALUES (?, ?, ?, ?, 'admin')");
		return $stmt->execute([$username, $name, $email, $hashedPassword]);
	} catch (PDOException $e) {
		return false;
	}
}

$message = '';

// Handle add admin action
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && (string) ($_POST['action'] ?? '') === 'add_admin') {
	$username = trim($_POST['username'] ?? '');
	$name = trim($_POST['name'] ?? '');
	$email = trim($_POST['email'] ?? '');
	$password = trim($_POST['password'] ?? '');

	if (empty($username) || empty($name) || empty($email) || empty($password)) {
		$message = '<div class="alert alert-danger">All fields are required.</div>';
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$message = '<div class="alert alert-danger">Invalid email address.</div>';
	} else {
		$added = bh_add_admin_to_db($username, $name, $email, $password);
		$message = $added
			? '<div class="alert alert-success">Admin account created successfully!</div>'
			: '<div class="alert alert-danger">Failed to create admin account. Email or username may already exist.</div>';
	}
}

// Handle delete user action
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && (string) ($_POST['action'] ?? '') === 'delete') {
	$userId = (int) ($_POST['user_id'] ?? 0);
	if ($userId <= 0) {
		$message = '<div class="alert alert-danger">Invalid user id.</div>';
	} else {
		$deleted = bh_delete_user_from_db($userId);
		$message = $deleted
			? '<div class="alert alert-success">User deleted successfully!</div>'
			: '<div class="alert alert-danger">User not found.</div>';
	}
}

$users = bh_fetch_users_from_db();
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

<body class="admin-page admin-sidebar-layout d-flex flex-column min-vh-100">
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
							<p class="admin-dashboard-subtitle mb-0">Manage all users in the system</p>
						</div>
						<div class="d-flex gap-2">
							<button type="button" class="btn admin-btn admin-btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAdminModal">
								<i class="bi bi-person-plus me-1"></i>Add Admin
							</button>
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
											<th>Name</th>
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
											<td class="fw-semibold"><?php echo htmlspecialchars($user['name'] ?? ''); ?></td>
											<td class="text-muted"><?php echo htmlspecialchars($user['email']); ?></td>
											<td><span class="admin-badge"><?php echo htmlspecialchars($user['role']); ?></span></td>
											<td>
												<span class="admin-status <?php echo strtolower($user['status']) === 'pending' ? 'admin-status-muted' : ''; ?>">
													<?php echo htmlspecialchars($user['status']); ?>
												</span>
											</td>
											<td class="text-muted"><?php echo ($user['created_at'] ?? '') !== '' ? date('M d, Y', strtotime($user['created_at'])) : '-'; ?></td>
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

	<!-- Add Admin Modal -->
	<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content" style="border-radius: 18px; border: 1px solid rgba(111, 78, 55, 0.14); background: linear-gradient(155deg, #fffaf4 0%, #f8f0e4 100%);">
				<div class="modal-header" style="border-bottom: 1px solid rgba(111, 78, 55, 0.14);">
					<h5 class="modal-title fw-bold" id="addAdminModalLabel" style="color: #3f291f;">
						<i class="bi bi-person-plus me-2"></i>Add New Admin
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="POST" id="addAdminForm">
					<input type="hidden" name="action" value="add_admin">
					<div class="modal-body" style="padding: 1.5rem;">
						<div class="mb-3">
							<label for="adminUsername" class="form-label" style="font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #7b5d48;">
								<i class="bi bi-at me-1"></i>Username
							</label>
							<input type="text" name="username" class="form-control" id="adminUsername" required style="border: 1px solid rgba(111, 78, 55, 0.24); border-radius: 10px; padding: 0.6rem 0.75rem;">
						</div>
						<div class="mb-3">
							<label for="adminName" class="form-label" style="font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #7b5d48;">
								<i class="bi bi-person me-1"></i>Full Name
							</label>
							<input type="text" name="name" class="form-control" id="adminName" required style="border: 1px solid rgba(111, 78, 55, 0.24); border-radius: 10px; padding: 0.6rem 0.75rem;">
						</div>
						<div class="mb-3">
							<label for="adminEmail" class="form-label" style="font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #7b5d48;">
								<i class="bi bi-envelope me-1"></i>Email Address
							</label>
							<input type="email" name="email" class="form-control" id="adminEmail" required style="border: 1px solid rgba(111, 78, 55, 0.24); border-radius: 10px; padding: 0.6rem 0.75rem;">
						</div>
						<div class="mb-3">
							<label for="adminPassword" class="form-label" style="font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #7b5d48;">
								<i class="bi bi-lock me-1"></i>Password
							</label>
							<input type="password" name="password" class="form-control" id="adminPassword" required style="border: 1px solid rgba(111, 78, 55, 0.24); border-radius: 10px; padding: 0.6rem 0.75rem;">
						</div>
						<div class="alert alert-info border-0" style="background: rgba(150, 75, 0, 0.1); color: #7b5d48; font-size: 0.85rem;">
							<i class="bi bi-info-circle me-2"></i>This will create a new admin account with full access.
						</div>
					</div>
					<div class="modal-footer" style="border-top: 1px solid rgba(111, 78, 55, 0.14);">
						<button type="button" class="btn admin-btn admin-btn-ghost btn-sm" data-bs-dismiss="modal">
							<i class="bi bi-x-circle me-1"></i>Cancel
						</button>
						<button type="submit" class="btn admin-btn admin-btn-primary btn-sm">
							<i class="bi bi-check-circle me-1"></i>Create Admin
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<footer class="bh-footer-bar px-4 px-lg-5 py-4 mt-auto">
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
