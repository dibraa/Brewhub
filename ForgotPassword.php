<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Brewhub Forgot Password</title>
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
						<img src="Assets/Brew_Hub.png" alt="" style="width: 150px; height: 150px;">
						<h1>Forgot Password</h1>
						<p>Enter your email to receive a code</p>
					</header>

					<form action="#" method="post" autocomplete="off">
						<label for="email" class="form-label">Email</label>
						<div class="input-group mb-2">
							<input id="email" name="email" type="email" class="form-control" required>
							<button class="btn btn-login" type="submit" name="action" value="send_code">Send</button>
						</div>

						<div class="mb-2">
							<label for="code" class="form-label">Code</label>
							<input id="code" name="code" type="text" class="form-control" required>
						</div>

						<div class="mb-3">
							<label for="new_password" class="form-label">New Password</label>
							<input id="new_password" name="new_password" type="password" class="form-control border-0 border-bottom rounded-0" required>
						</div>

						<button type="submit" class="btn btn-login w-100">Reset Password</button>
					</form>

					<p class="signup-note">Back to <a href="Login.php">Log In</a></p>
				</div>
			</section>
		</div>
	</main>
</body>
</html>
