<?php include 'server/db_connection.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'templates/header.php' ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link href="homepage/assets/img/favicon.png" rel="icon">                 
	<title>Certifast Portal</title>
    <link href="homepage/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="homepage/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="homepage/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="homepage/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="homepage/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="homepage/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="homepage/assets/css/style.css" rel="stylesheet">
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>
	    <div class="wrapper">
            <?php include 'templates/main-header-resident.php' ?>
            <?php include 'templates/sidebar-resident.php' ?>
		    <div class="main-panel">
			    <div class="content">
                    <div>
                        <h1 class="text-center fw-bold mt-5" style="font-size: 300%;">Barangay Los Amigos - CertiFast Portal</h1>
                        <h5 class="text-center fw-bold"> Barangay Los Amigos online certificate management system has got you covered. Enjoy fast and easy access to your certificates with just a few clicks.  </h5>
                    </div>
                    <div class="page-inner">
                    <section id="about" class="about section-bg">
                        <div class="container" data-aos="fade-up">
                                <div class="section-title">
                                    <h6></h6>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                                        <img src="homepage/assets/img/hero-bg.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                                            <h3>Barangay Los Amigos - CertiFast Portal</h3>
                                            <p>
                                            The Certifast Portal provides a user-friendly platform for efficient and secure handling of certificates, revolutionizing the process of issuance and management.
                                            </p>
                                        <ul>
                                            <li>
                                                <i class="bx bx-check"></i>
                                                <div>
                                                    <h5>Our Mission</h5>
                                                    <p>Our mission is to create an efficient and secure certificate management system that ensures accuracy, accessibility, and timely delivery while maintaining data privacy and integrity.</p>
                                                </div>
                                            </li>
                                            <li>
                                                <i class="bx bx-check"></i>
                                                <div>
                                                    <h5>Our Vision</h5>
                                                    <p>Our vision aims to simplify certificate issuance, tracking, and management, promoting transparency and improving service delivery.</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
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