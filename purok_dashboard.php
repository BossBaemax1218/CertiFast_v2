<?php 
include 'server/server.php';
$query = "SELECT COUNT(DISTINCT details) as de FROM tblpayments WHERE details IN ('Barangay Clearance Payment', 'Business Permit Payment', 'Certificate of Residency Payment', 'Certificate of Indigency Payment')"; 
$revenue1 = $conn->query($query)->fetch_assoc();

$sql1 = "SELECT COUNT(name) as receipt FROM tblpayments";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();
$receiptCount = $row1['receipt'];

$query2 = "SELECT SUM(amounts) as am FROM tblpayments ORDER BY `date` DESC";
$revenue3 = $conn->query($query2)->fetch_assoc();

$sql = "SELECT * FROM tblpayments ORDER BY `date` DESC";
$result = $conn->query($sql);

$revenue = array();
while($row = $result->fetch_assoc()){
	$revenue[] = $row; 
} 
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
					<div class="form">
                        <h1 class="text-center fw-bold mt-5" style="font-size: 300%;">Barangay Los Amigos - CertiFast Portal</h1>
                        <h5 class="text-center fw-bold"> Barangay Los Amigos online certificate management system has got you covered. Enjoy fast and easy access to your certificates with just a few clicks.  </h5>
                    </div>
					<div class="page-inner">
						<?php if(isset($_SESSION['message'])): ?>
								<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
									<?php echo $_SESSION['message']; ?>
								</div>
							<?php unset($_SESSION['message']); ?>
						<?php endif ?>							
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-stats card card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-user-plus fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Request</h2>
                                                    <h3 class="fw-bold" style="font-size: 35px; color: #C77C8D;"><?= number_format($receiptCount) ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="purok_info.php?state=purok" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-stats card card-round" >
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-user-clock fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">On Hold</h2>
                                                    <h3 class="fw-bold" style="font-size: 35px; color: #C77C8D;"><?= number_format($revenue3['am'],2)?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="revenue.php?state=revenue" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-user-check fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Approved</h2>
                                                    <h3 class="fw-bold text-uppercase" style="font-size: 35px; color: #C77C8D;"><?= number_format($revenue1['de']) ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="purok_info.php?state=purok" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
					    </div>
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
												<p class="description" style="color: black;">Make sure your personal information is true and correct by <b>reviewing it carefully</b> on the screen. Don't submit it abortly.</p>
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
                    </div>
				<?php include 'templates/main-footer.php' ?>
            </div>
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
