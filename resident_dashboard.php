<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>  
        <meta charset="utf-8">
        <meta content="" name="description">
        <meta content="" name="keywords">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>CertiFast Portal</title>

        <link href="homepage/assets/img/favicon.png" rel="icon">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="homepage/assets/css/resident-style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>
  <body>
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="index.php"><img src="homepage/assets/img/title-logo.png" alt="title-logo"></a></h1>
	  <a class="btn-logout" href="model/logout.php">Logout</a>
    </div>
  </header>
<?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'login'): ?>
	<header id="header-alert">
		<div class="alert alert-<?php echo $_SESSION['success']; ?>" role="alert">
			<?php if ($_SESSION['success'] == 'danger'): ?>
				<i class="fas fa-exclamation-triangle"></i>
			<?php elseif ($_SESSION['success'] == 'success'): ?>
				<i class="fas fa-check-circle"></i>
			<?php endif; ?>
			<span class="alert-message"><?php echo $_SESSION['message']; ?></span>
		</div>
	</header>
	<?php unset($_SESSION['message']); ?>
<?php endif; ?>
  <section class="main-content">
		<div class="container">
			<h1 class="text-center">Online Application for <b>CertiFast Portal</b></h1>
			<p class="text-center text-muted">What certifications must you have, and where can you request them? </p>
			<br>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 mb-4">
        			<a href=""><div class="profile-card shadow mb-4 text-center p-4 position-relative h-100">
						<div class="profile-card_image">
							<img src="assets/img/icons/residency-cert.png" alt="User" class="mb-4 shadow">
						</div>
						<div class="profile-card_details">
							<h4 class="mb-0">Barangay Residency</h4>
							<p class="text-muted"></p>
							<p class="text-muted">Sheytttttttttttttttttt</p>
						</div>
					</div></a>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 mb-4">
        			<a href=""><div class="profile-card shadow mb-4 text-center p-4 position-relative h-100">
						<div class="profile-card_image">
							<img src="assets/img/icons/clearance.png" alt="User" class="mb-4 shadow">
						</div>
						<div class="profile-card_details">
							<h4 class="mb-0">Barangay Clearance</h4>
							<p class="text-muted"></p>
							<p class="text-muted">Sheytttttttttttttttttt</p>
						</div>
					</div></a>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
          			<a href=""><div class="profile-card shadow mb-4 text-center p-4 position-relative h-100">
						<div class="profile-card_image">
							<img src="assets/img/icons/indigency.png" alt="User" class="mb-4 shadow">
						</div>
						<div class="profile-card_details">
							<h4 class="mb-0">Barangay Indigency</h4>
							<p class="text-muted"></p>
							<p class="text-muted">Sheytttttttttttttttttt</p>
						</div>
					</div></a>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        			<a href=""><div class="profile-card shadow mb-4 text-center p-4 position-relative h-100">
						<div class="profile-card_image">
							<img src="assets/img/icons/permit.png" alt="User" class="mb-4 shadow">
						</div>
						<div class="profile-card_details">
							<h4 class="mb-0">Business Permit</h4>
							<p class="text-muted"></p>
							<p class="text-muted">Sheytttttttttttttttttt</p>
						</div>
					</div></a>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        			<a href=""><div class="profile-card shadow mb-4 text-center p-4 position-relative h-100">
						<div class="profile-card_image">
							<img src="assets/img/icons/card.png" alt="User" class="mb-4 shadow">
						</div>
						<div class="profile-card_details">
							<h4 class="mb-0">Barangay ID</h4>
							<p class="text-muted"></p>
							<p class="text-muted">Sheytttttttttttttttttt</p>
						</div>
					</div>
				</div></a>
			</div>
		</div>
	</section>
  <footer class="footer">
        <div class="copyright">
            <?php $year = date("Y"); echo  $year . " &copy Barangay Los Amigos - CertiFast Portal . All right reserved"  ?>
        </div>				
  </footer>
    </body>
</html>
