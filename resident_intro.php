<?php 
    include 'server/db_connection.php';

    $query1 = "SELECT * FROM tblbrgy_info WHERE id='1'";
    $result1 = $conn->query($query1)->fetch_assoc();

    $query = "SELECT tblofficials.fullname, tblofficials.picture, tblposition.position FROM tblofficials JOIN tblposition ON tblofficials.position = tblposition.id WHERE tblposition.position IN ('Punong Barangay','Secretary','Treasurer','Kagawad') AND `status`='Active'";
    $result = $conn->query($query);

    $rows = array();
    while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
    }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'templates/header.php' ?>                
	<title>Certifast Portal</title>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>
    <div class="wrapper">
        <?php include 'templates/main-header-resident.php' ?>
        <?php include 'templates/sidebar-resident.php' ?>
		<div class="main-panel">
            <div class="content">
                <h1 class="text-center fw-bold mt-5" style="font-size: 400%;">Barangay Officials & Kagawad Officials</h1><br> 
                <div class="page-inner">
                    <section id="team" class="team section-bg">
                        <div class="container" data-aos="fade-up">
                            <div class="row">
                                <?php foreach ($rows as $row): ?>
                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                                        <div class="member">
                                            <div class="member-img">
                                            <img src="assets/uploads/officials_profile/<?= $row['picture'] ?>" class="img-fluid" alt="">
                                            </div>
                                            <div class="member-info">
                                            <h4><?= ucwords($row['fullname']) ?></h4>
                                            <h6><i><?= ucwords($row['position']) ?></i></h6>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </section>
                    <h1 class="text-center fw-bold mt-5" style="font-size: 400%;">Barangay Los Amigos</h1><br> 
                    <section id="about" class="about section-bg">
                        <div class="container" data-aos="fade-up">
                            <div class="row">
                                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                                    <img src="Homepage/assets/img/hero-bg.jpg" class="img-fluid" alt="">
                                </div>
                                <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                                    <ul>
                                        <h3><b>Barangay Los Amigos - CertiFast Portal</b></h3>
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