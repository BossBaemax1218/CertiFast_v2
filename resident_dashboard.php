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
</head>
  <body>
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="index.php"><img src="homepage/assets/img/title-logo.png" alt="title-logo"></a></h1>
    </div>
  </header>
  <section class="main-content">
		<div class="container">
			<h1 class="text-center">Online Application for <b>CertiFast Portal</b></h1>
			<p class="text-center text-muted">What are the certification do you need? </p>
			<br><br>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
					<div class="profile-card bg-white shadow mb-4 text-center rounded-lg p-4 position-relative h-100">
						<div class="profile-card_image">
							<img src="images/users/user1.jpg" alt="User" class="mb-4 shadow">
						</div>
						<div class="profile-card_details">
							<h4 class="mb-0">Barangay Registration</h4>
							<p class="text-muted">CEO, Co-founder</p>
							<p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum ab eum magni nobis autem dolorum!</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
					<div class="profile-card bg-white shadow mb-4 text-center rounded-lg p-4 position-relative h-100">
						<div class="profile-card_image">
							<img src="images/users/user2.jpg" alt="User" class="mb-4 shadow">
						</div>
						<div class="profile-card_details">
							<h4 class="mb-0">Barangay Residency</h4>
							<p class="text-muted">CEO, Co-founder</p>
							<p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum ab eum magni nobis autem dolorum!</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
					<div class="profile-card bg-white shadow mb-4 text-center rounded-lg p-4 position-relative h-100">
						<div class="profile-card_image">
							<img src="images/users/user3.jpg" alt="User" class="mb-4 shadow">
						</div>
						<div class="profile-card_details">
							<h4 class="mb-0">Barangay Clearance</h4>
							<p class="text-muted">CEO, Co-founder</p>
							<p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum ab eum magni nobis autem dolorum!</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
					<div class="profile-card bg-white shadow mb-4 text-center rounded-lg p-4 position-relative h-100">
						<div class="profile-card_image">
							<img src="images/users/user4.jpg" alt="User" class="mb-4 shadow">
						</div>
						<div class="profile-card_details">
							<h4 class="mb-0">Barangay Indigency</h4>
							<p class="text-muted">CEO, Co-founder</p>
							<p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum ab eum magni nobis autem dolorum!</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
					<div class="profile-card bg-white shadow mb-4 text-center rounded-lg p-4 position-relative h-100">
						<div class="profile-card_image">
							<img src="images/users/user5.jpg" alt="User" class="mb-4 shadow">
						</div>
						<div class="profile-card_details">
							<h4 class="mb-0">Business Permit</h4>
							<p class="text-muted">CEO, Co-founder</p>
							<p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum ab eum magni nobis autem dolorum!</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
					<div class="profile-card bg-white shadow mb-4 text-center rounded-lg p-4 position-relative h-100">
						<div class="profile-card_image">
							<img src="images/users/user6.jpg" alt="User" class="mb-4 shadow">
						</div>
						<div class="profile-card_details">
							<h4 class="mb-0">Barangay ID</h4>
							<p class="text-muted">CEO, Co-founder</p>
							<p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum ab eum magni nobis autem dolorum!</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
  <footer class="footer">
    <div class="container-fluid">
        <div class="copyright ml-auto">
            <?php $year = date("Y"); echo  $year . " &copy CertiFast Portal" ?>
        </div>				
    </div>
  </footer>
    </body>
</html>
