<?php
session_start();
require 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please enter a valid email address.";
        header('Location: ForgotPassword.php');
        exit();
    }

    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $reset_code = sprintf('%06d', rand(100000, 999999));
        $update = $conn->prepare("UPDATE users SET reset_code = ? WHERE email = ?");
        $update->bind_param('ss', $reset_code, $email);
        $update->execute();

        $_SESSION['email'] = $email;

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USERNAME;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = SMTP_PORT;

            $mail->setFrom(FROM_EMAIL, FROM_NAME);
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Password Reset Code - BrewHub";
            $mail->Body = "<p>Your reset code: <strong>{$reset_code}</strong></p>";
            $mail->AltBody = "Your reset code: {$reset_code}";

            $mail->send();

            header('Location: verify-code.php');
            exit();

        } catch (Exception $e) {
            $_SESSION['error'] = "Failed to send email.";
            header('Location: ForgotPassword.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Email not found.";
        header('Location: ForgotPassword.php');
        exit();
    }
}
?>

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
						 <?php if(isset($_SESSION['error'])): ?>
            			<div style="color: #dc3545; background: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">
                		<?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            			</div>
        				<?php endif; ?>
							<div class="mb-2">
								<input id="email" name="email" type="email" class="form-control" required>
							</div>
							<button class="btn btn-login w-100" type="submit" name="action" value="send_code">Send</button>

					<p class="signup-note">Back to <a href="Login.php">Log In</a></p>
				</div>
			</section>
		</div>
	</main>
</body>
</html>
