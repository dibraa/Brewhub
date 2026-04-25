<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Brewhub</title>
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
				<img src="Assets/Suplies.png">
				
			</aside>

			<section class="col-lg-7 auth-pane">
				<div class="form-shell">
					<header class="text-center">
						<img src="Assets/Brew_Hub.png" alt="" Style="width: 150px; height: 150px;">
						<h1>Brewhub</h1>
						<p>Your Shop's One-Stop Supply</p>
					</header>

					<form id="loginForm" method="post" autocomplete="off">
					
					<div id="errorMsg" style="display:none;" class="alert alert-danger py-2" role="alert">Invalid email or password!</div>

					<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input id="email" name="email" type="email" class="form-control" required>
						</div>

						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input id="password" name="password" type="password" class="form-control border-0 border-bottom rounded-0"  required>
						</div>

						<div class="text-end mb-3">
							<a href="ForgotPassword.php" class="forgot-link">Forgot your password?</a>
						</div>

						<button type="submit" class="btn btn-login w-100">Log In</button>
					</form>

					<div class="or-divider" aria-hidden="true"><span>OR</span></div>

					<div class="social-row">			
						<a class="social-btn" href="#"><i class="bi bi-google"></i> Sign in with Google</a>
					</div>

					<p class="signup-note">Don't have an account? <a href="Signup.php">Sign Up</a></p>
				</div>
			</section>
		</div>
	</main>

	<script>
		document.getElementById('loginForm').addEventListener('submit', function(e){
			e.preventDefault();

			const formData = new FormData(this);

			fetch('validate.php', {
				method: "POST",
				body: formData
			})
			.then(response => response.json())
			.then(data => {
				if(data.status === 'success'){
					window.location.href = data.redirect;
				} else {
					const errorMsg = document.getElementById('errorMsg');
					errorMsg.style.display = 'block';
					errorMsg.textContent = data.message;
				}
			})
			.catch(error => {
				const errorMsg = document.getElementById('errorMsg');
				errorMsg.style.display = 'block';
				errorMsg.textContent = 'Wrong credentials. Please try again.';
			});
		});
	</script>

</body>
</html>
