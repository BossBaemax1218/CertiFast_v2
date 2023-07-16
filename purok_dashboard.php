<?php 
include 'server/server.php' 
?>
<!DOCTYPE html>
<html lang="en">
<head>  
	<?php include 'templates/header.php' ?>
  <link href="homepage/assets/img/favicon.png" rel="icon">                 
	<title>Certifast Portal</title>
    <link href="homepage/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="homepage/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="homepage/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="homepage/assets/css/style.css" rel="stylesheet">
</head>
  <body>
  <?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
			<div class="main-panel">
				<div class="content">
					<section class="main-content mt-2">
						<div class="container mt-5">
							<div>
								<h1 class="text-center">Barangay Los Amigos - <strong>CertiFast Portal</strong></h1>
								<h5 class="text-center fw-bold"> Here are the steps in setting an registration request with CertiFast Portal.</h5>
							</div>
							<?php if(isset($_SESSION['message'])): ?>
									<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
										<?php echo $_SESSION['message']; ?>
									</div>
								<?php unset($_SESSION['message']); ?>
							<?php endif ?>
							<br>
							<section id="featured-services" class="featured-services">
								<div class="container" data-aos="fade-up">
									<div class="row">
										<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
											<a href="#services"><div class="icon-box" data-aos="fade-up" data-aos-delay="100">
												<div class="icon"><img src="homepage/assets/img/clients/logo-8.svg"></div>
												<h4 class="title" style="color: black;">Step 1</h4>
												<h6 class="pre-title" style="color: black; font-weight: bold;">Request</h6>
												<p class="description" style="color: black;">Go to form and <strong>submit a request</strong> by registrating your personal information that you would like to request in CertiFast Portal.</p>
											</div></a>
										</div>
										<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
											<a href="#services"><div class="icon-box" data-aos="fade-up" data-aos-delay="100">
												<div class="icon"><img src="homepage/assets/img/clients/logo-14.svg"></div>
												<h4 class="title" style="color: black;">Step 2</h4>
												<h6 class="pre-title" style="color: black; font-weight: bold;">Review</h6>
												<p class="description" style="color: black;">Make sure your personal information is true and correct by <b>reviewing it carefully</b> on the screen.</p>
											</div></a>
										</div>
										<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
											<a href="#services"><div class="icon-box" data-aos="fade-up" data-aos-delay="100">
												<div class="icon"><img src="homepage/assets/img/clients/logo-10.svg"></div>
												<h4 class="title" style="color: black;">Step 3</h4>
												<h6 class="pre-title" style="color: black; font-weight: bold;">Interview</h6>
												<p class="description" style="color: black;">Go to <b>Barangay Office of Los Amigos</b>, we need to have few essential interview to guarantee the authenticity of your information.</p>
											</div></a>
										</div>	
										<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
											<a href="#services"><div class="icon-box" data-aos="fade-up" data-aos-delay="100">
												<div class="icon"><img src="homepage/assets/img/clients/logo-11.svg"></div>
												<h4 class="title" style="color: black;">Step 4</h4>
												<h6 class="pre-title" style="color: black; font-weight: bold;">Release</h6>
												<p class="description" style="color: black;">Prepare a <b>cash in hand</b> to ensure you can pay for the certificate after a quick interview. Please make sure you had your cash.</p>
											</div></a>
										</div>
									</div>
								</div> 
                    		</section>
						</div>
					</section>
				</div>
				<?php include 'templates/main-footer.php' ?>
			</div>
  		</div>
		  <?php include 'templates/footer.php' ?>
		  <script src="homepage/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="homepage/assets/vendor/aos/aos.js"></script>
    <script src="homepage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="homepage/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="homepage/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="homepage/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="homepage/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="homepage/assets/vendor/php-email-form/validate.js"></script>
    <script src="homepage/assets/js/main.js"></script>
    </body>
</html>
