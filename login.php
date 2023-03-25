<?php 
	session_start(); 
	if(isset($_SESSION['username'])){
		header('Location: dashboard.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'templates/header.php' ?>
	<link rel="stylesheet" href="assets/css/login.css">
	<title>Login</title>

<body class="login">
	<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper wrapper-login">
        
		<div class="container container-login animated fadeIn">
            <?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                    <?= $_SESSION['message']; ?>
                </div>
            <?php unset($_SESSION['message']); ?>
            <?php endif ?>
			<h3 class="text-center">Welcome to CertiFast</h3>
			<div class="login-form">
                <form method="POST" action="model/login.php">
				<div class="form-group form-floating-label">
					<input id="username" name="username" type="text" class="form-control input-border-bottom" placeholder="Username" required>
				</div>
				<div class="form-group form-floating-label">
					<input id="password" name="password" type="password" class="form-control input-border-bottom" placeholder="Password" required>
					<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
				</div>
				<div class="form-action mb-3">
                    <button type="submit" class="btn btn-danger btn-rounded btn-login">Sign In</button>
				</div>
                </form>
			</div>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
</body>
</html>