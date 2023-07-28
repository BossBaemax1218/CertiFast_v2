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
                        <h1 class="text-center fw-bold mt-5" style="font-size: 300%;">Barangay Los Amigos - CertiFast Portal</h1><br>
                        <h6 class="text-center" style=" font-size: 16px; text-align: justify;"> Barangay Los Amigos online certificate management system has got you covered. Enjoy fast and easy access to your certificates with just a few clicks.  </h6>
                    <div class="page-inner mt-5">
                        <section id="about" class="about section-bg">
                            <div class="container mt-5" data-aos="fade-up">
                                <div class="row">
                                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                                        <img src="Homepage/assets/img/hero-bg.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                                        <ul>
                                            <h3>Barangay Los Amigos - CertiFast Portal</h3>
                                            <span>The Certifast Portal provides a user-friendly platform for efficient and secure handling of certificates, revolutionizing the process of issuance and management.</span><br>
                                            <br><h5><b>Our Mission</b></h5>
                                            <p>The Barangay Los Amigos envisions to be more industrious, abundant and secure community to live in where residents enjoy harmonious way of life without any uncertainties in mind at work and at home and most especially for a more directed and progressive Barangay Governance. </p>
                                            <h5><b>Our Vision</b></h5>
                                            <p>The Barangay Los Amigos commits to perform better duties and responsibilities to carry out the plans and objectives of the barangay through voluntary and excellent performance especially in the delivery of the basic needs such as improved roads, water system, health care, education, agricultural farming and the safety of the residents in all hazards around the barangay.</p>
                                            <h5><b>Our Goal</b></h5>
                                            <p>The barangay aims to provide the basic needs of the residents such as road concreting of the different puroks.</p>
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