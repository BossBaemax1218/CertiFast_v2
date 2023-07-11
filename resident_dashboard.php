<?php include 'server/db_connection.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>  
	<?php include 'templates/header.php' ?>
    <title>CertiFast Portal</title>
</head>
  <body>
  <?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header-resident.php' ?>
		<?php include 'templates/sidebar-resident.php' ?>
			<div class="main-panel">
				<div class="content">
					<section class="main-content mt-5">
						<div class="container">
							<h1 class="text-center">Barangay Los Amigos - <strong>CertiFast Portal</strong></h1>
							<h3 class="text-center text-muted">Simplifying Certificates for a Connected Community. </h3>
							<br>
							<?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'login'): ?>
								<header id="header">
									<div class="alert alert-<?php echo $_SESSION['success']; ?>" role="alert">
										<?php if ($_SESSION['success'] == 'danger'): ?>
											<i class="fas fa-exclamation-triangle"></i>
										<?php elseif ($_SESSION['success'] == 'success'): ?>
											<i class="fas fa-check-circle"></i>
										<?php endif; ?>
										<span class="alert-message"> <?php echo $_SESSION['message']; ?> </span>
									</div>
								</header>
								<?php unset($_SESSION['message']); ?>
							<?php endif; ?>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 mb-4">
									<div class="profile-card shadow mb-4 text-center p-4 position-relative h-100">
										<div class="profile-card_image">
											<img src="assets/img/icons/residency-cert.png" alt="User" class="mb-4 shadow">
										</div>
										<div class="profile-card_details text-left">
										<h2 class="text-center">Barangay Residency</h2>
										<br>
										<p>The necessary documents for the submission of a Barangay Residency commonly include the following: </p>
										<ul class="req-list"> 
											<li>Barangay certificate from your previous barangay (if any).</li>
											<li>A valid ID, passport, birth certificate or marriage certificate.</li>
											<li>Photocopy of any Utility Bill or Proof of Billing (such as electric bill, water bill, etc.) </li>
											<li>A barangay clearance or certificate of residency.</li>
										</ul>
									</div>
									<br>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 mb-4">
									<div class="profile-card shadow mb-4 text-center p-4 position-relative h-100">
										<div class="profile-card_image">
											<img src="assets/img/icons/clearance.png" alt="User" class="mb-4 shadow">
										</div>
										<div class="profile-card_details text-left">
											<h2 class="text-center">Barangay Clearance</h2>
											<br>
											<p>The necessary documents for the submission of a Barangay Residency commonly include the following: </p>
											<ul class="req-list"> 
												<li>Barangay certificate from your previous barangay (if any).</li>
												<li>A valid ID, passport, birth certificate or marriage certificate.</li>
												<li>Photocopy of any Utility Bill or Proof of Billing (such as electric bill, water bill, etc.) </li>
												<li>A barangay clearance or certificate of residency.</li>
											</ul>
										</div>
										<br>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 mb-4">
									<div class="profile-card shadow mb-4 text-center p-4 position-relative h-100">
										<div class="profile-card_image">
											<img src="assets/img/icons/indigency.png" alt="User" class="mb-4 shadow">
										</div>
										<div class="profile-card_details text-left">
											<h2 class="text-center">Barangay Indigency</h2>
											<br>
											<p>The necessary documents for the submission of a Barangay Residency commonly include the following: </p>
											<ul class="req-list"> 
												<li>Barangay certificate from your previous barangay (if any).</li>
												<li>A valid ID, passport, birth certificate or marriage certificate.</li>
												<li>Photocopy of any Utility Bill or Proof of Billing (such as electric bill, water bill, etc.) </li>
												<li>A barangay clearance or certificate of residency.</li>
											</ul>
										</div>
										<br>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 mb-4">
									<div class="profile-card shadow mb-4 text-center p-4 position-relative h-100">
										<div class="profile-card_image">
											<img src="assets/img/icons/permit.png" alt="User" class="mb-4 shadow">
										</div>
										<div class="profile-card_details text-left">
											<h2 class="text-center">Business Permit</h2>
											<br>
											<p>The necessary documents for the submission of a Barangay Residency commonly include the following: </p>
											<ul class="req-list"> 
												<li>Barangay certificate from your previous barangay (if any).</li>
												<li>A valid ID, passport, birth certificate or marriage certificate.</li>
												<li>Photocopy of any Utility Bill or Proof of Billing (such as electric bill, water bill, etc.) </li>
												<li>A barangay clearance or certificate of residency.</li>
											</ul>
										</div>
										<br>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<?php include 'templates/main-footer.php' ?>
			</div>
  		</div>
		  <?php include 'templates/footer.php' ?>
    </body>
</html>
