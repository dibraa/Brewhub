<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Profile</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
		<link href="Style.css" rel="stylesheet">
</head>
<body class="dashboard-page">
	<nav class="navbar navbar-expand-md navbar-light fixed-top bh-navbar">
		<div class="container-fluid px-4 px-lg-5 bh-nav-container">
			<a class="navbar-brand bh-brand" href="Buyer/Dashboard.php">Brewhub</a>

			<div class="d-flex align-items-center gap-2 order-md-3 bh-nav-actions active">
				<a class="btn bh-icon-btn" href="Profile.php" aria-label="Profile">
					<i class="bi bi-person"></i>
				</a>
				<a class="btn bh-icon-btn position-relative" href="#" aria-label="Cart">
					<i class="bi bi-bag"></i>
					<span class="bh-cart-count">2</span>
				</a>
				<button class="navbar-toggler border-0 shadow-none p-0 ms-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>

			<div class="collapse navbar-collapse justify-content-center order-md-2" id="navbarNav">
				<ul class="navbar-nav align-items-md-center gap-md-4 gap-lg-5 bh-nav-links">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="Buyer/Dashboard.php">Home</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="productCategoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Product Categories</a>
						<ul class="dropdown-menu" aria-labelledby="productCategoriesDropdown">
							<li><a class="dropdown-item" href="#">Coffee & Ingredients</a></li>
							<li><a class="dropdown-item" href="#">Cups & Packaging</a></li>
							<li><a class="dropdown-item" href="#">Equipments</a></li>
							<li><a class="dropdown-item" href="#">Pastry</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<main class="profile-page-main py-5">
		<div class="container profile-container">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-9 col-xl-8">
					<section class="card border-0 profile-card">
						<div class="card-body p-4 p-md-5">
							<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-3 mb-4">
								<div>
									<p class="profile-kicker mb-2"><i class="bi bi-cup-hot me-2"></i>Brewhub Account</p>
									<h1 class="profile-title h3 mb-0">My Profile</h1>
								</div>
								<div class="d-flex flex-column flex-sm-row align-items-sm-center gap-2">
									<span class="badge rounded-pill profile-status-badge"><i class="bi bi-person-check-fill me-1"></i>Buyer</span>
									<select class="form-select form-select-sm profile-status-select" aria-label="Account role">
										<option selected>Buyer</option>
										<option>Seller</option>
									</select>
								</div>
							</div>

							<div class="profile-info-list mb-4">
								<div class="profile-info-item">
									<div class="profile-info-label"><i class="bi bi-at me-2"></i>Username</div>
									<div class="profile-info-value">@brewlover_07</div>
								</div>
								<div class="profile-info-item">
									<div class="profile-info-label"><i class="bi bi-person-vcard me-2"></i>Full Name</div>
									<div class="profile-info-value">Dave Nathaniel Pequero</div>
								</div>
								<div class="profile-info-item">
									<div class="profile-info-label"><i class="bi bi-envelope me-2"></i>Email Address</div>
									<div class="profile-info-value">Dib.peq@brewhub.com</div>
								</div>
							</div>

							<div class="d-flex flex-column flex-sm-row gap-3">
								<a class="btn profile-btn profile-btn-edit" href="#"><i class="bi bi-pencil-square me-2"></i>Edit Profile</a>
								<a class="btn profile-btn profile-btn-seller" href="BecomeSeller.php?fullname=dib;email=dave%40brewhub.com"><i class="bi bi-shop me-2"></i>Become a Seller</a>
							</div>
						</div>
					</section>
				</div>
			</div>
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
