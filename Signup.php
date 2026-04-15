<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Brewhub Sign Up</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="Style.css" rel="stylesheet">
</head>
<body class="auth-page">
	<main class="auth-card container-fluid p-0">
		<div class="row g-0 h-100">
			<aside class="col-lg-5 auth-visual">
				<img src="Assets/Suplies.png" alt="Coffee shop supplies">
			</aside>

			<section class="col-lg-7 auth-pane">
				<div class="form-shell">
					<header class="text-center">
						<h1>Create Account</h1>
						<p>Join Brewhub to manage your coffee shop essentials</p>
					</header>

					<form action="Login.php" method="post" autocomplete="off">
						<div class="mb-2">
							<label for="fullname" class="form-label">Full Name</label>
							<input id="fullname" name="fullname" type="text" class="form-control" autocomplete="name" required>
						</div>

						<div class="mb-2">
							<label for="username" class="form-label">Username</label>
							<input id="username" name="username" type="text" class="form-control" required>
						</div>

						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input id="password" name="password" type="password" class="form-control border-0 border-bottom rounded-0" required>
						</div>

						<button type="submit" class="btn btn-login w-100">Sign Up</button>
					</form>

					<div class="or-divider" aria-hidden="true"><span>OR</span></div>

					<div class="social-row">
						<a class="social-btn" href="#"><i class="bi bi-facebook"></i> Sign in with Facebook</a>
						<a class="social-btn" href="#"><i class="bi bi-google"></i> Sign in with Google</a>
					</div>

					<p class="signup-note">Already have an account? <a href="Login.php">Log In</a></p>
				</div>
			</section>
		</div>
	</main>
</body>
</html>
