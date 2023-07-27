<?php include 'server/server.php' ?>
<?php 
   include 'model/footer.php' 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Generate Resident Profile</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>

		<?php include 'templates/sidebar.php' ?>

		<div class="main-panel">
			<div class="content">
				<div class="panel-header">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
                                <h1 class="text fw-bold" style="font-size: 50px;">Generate Certificate</h1>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Resident Profile</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Certificate
											</button>
										</div>
									</div>
								</div>
								    <div class="card-body" id="printThis">
                                        <div class="header d-flex flex-wrap justify-content-around">
                                                <div class="text-center">
                                                    <h2 class="fw-bold mb-1">Republic of the Philippines</h2>
                                                    <h2 class="fw-bold mb-1">City of <?= ucwords($province) ?></h2>
                                                    <h1 class="fw-bold mb-1"  style="font-size: 40px;"><?= ucfirst($brgy) ?></i></h1>
                                                    <h2 class="fw-bold mb-2"><?= ucwords($town) ?></h2>				
                                                    <h3><i class="fas fa-phone" style="color: yellow;"></i> <span class="fw-bold"><?= $number ?></span>  &nbsp  <i class="fw-bold fa fa-envelope" style="color: yellow;"></i> <span class="fw-bold"><?= $b_email ?></span> </h3>
                                                </div>
                                            <div class="text-center mt-3">
                                                <img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid mr-4" width="150">
                                                <img src="assets/uploads/<?= $city_logo ?>" class="img-fluid" width="150">
                                            </div>
                                        </div>  
                                        <div class="col">
                                            <div class="text-center" style="margin-top: 30px;">
                                                <h1 class="fw-bold" style="font-size:42px;">RESIDENT INFORMATION</h1>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 mx-auto">
                                                    <div class="row">
                                                        <img src="<?= preg_match('/data:image/i', $resident['picture']) ? $resident['picture'] : 'assets/uploads/resident_profile/'.$resident['picture'] ?>" alt="Resident Profile" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="fw-bold mt-4 ml-5">Personal Information</h2>
                                            <div class="row ml-5" style="margin: 0px 0px 0px 100px;">
                                                <div class="col">
                                                    <div class="row">
                                                        <h3 class="fw-bold text-left">Name:</h3>
                                                    </div>
                                                    <div class="text-left">
                                                        <h3 type="text" style="font-size:20px"> <?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?></h3>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class=" row">
                                                        <h3 class="fw-bold text-left">Status:</h3>
                                                    </div>
                                                    <div class="text-left">
                                                        <h3 type="text"><?= $resident['resident_type']==1 ? 'Alive' : 'Deceased' ?></h3>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row">
                                                        <h3 class="fw-bold text-left">Address:</h3>
                                                    </div>
                                                    <div class="text-left">
                                                        <h3 type="text"><?= $resident['address'] ?></h3>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class=" row">
                                                        <h3 class="fw-bold text-left">Purok:</h3>
                                                    </div>
                                                    <div class="text-left">
                                                        <h3 type="text"><?= $resident['purok'] ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ml-5" style="margin: 0px 0px 0px 100px;">
                                                <div class="col">
                                                    <div class=" row">
                                                        <h3 class="fw-bold text-left">Birthdate:</h3>
                                                    </div>
                                                    <div class="text-left">
                                                        <h3 type="text"><?= date('F d, Y', strtotime($resident['birthdate'])) ?></h3>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class=" row">
                                                        <h3 class="fw-bold text-left">Age:</h3>
                                                    </div>
                                                    <div class="text-left">
                                                        <h3 type="text"><?= $resident['age'] ?></h3>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class=" row">
                                                        <h3 class="fw-bold text-left">Civil Status:</h3>
                                                    </div>
                                                    <div class="text-left">
                                                        <h3 type="text"><?= $resident['civilstatus'] ?></h3>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class=" row">
                                                        <h3 class="fw-bold text-left">Gender:</h3>
                                                    </div>
                                                    <div class="text-left">
                                                        <h3 type="text"><?= $resident['gender'] ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="row ml-5">
                                            <div class="col">
                                                <div class="row">
                                                    <h3 class="fw-bold text-left">Voters:</h3>
                                                </div>
                                                <div class="text-left">
                                                <h3 type="text"><?= $resident['voterstatus'] ?></h3>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <h3 class="fw-bold text-left">Phone number:</h3>
                                                </div>
                                                <div class="text-left">
                                                    <h3 type="text"><?= $resident['phone'] ?></h3>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <h3 class="fw-bold text-left">Occupation:</h3>
                                                </div>
                                                <div class="text-left">
                                                    <h3 type="text"><?= ucwords(trim($resident['occupation'])) ?></h3>
                                                </div>
                                            </div>
                                            <div class="col" style="margin-bottom: 300px;">
                                                <div class="row">
                                                    <h3 class="fw-bold text-left">Barangay ID #:</h3>                                                       
                                                </div>                                               
                                                <div class="text-left">
                                                    <h3 type="text" style="font-size:20px"><?= $resident['national_id'] ?></h3>
                                                </div>
                                            </div>
                                        </div>                                       
                                    <div class="footer-content">
                                        <div class="footer-names text-left">                                                       
                                            <ul>
                                                <li><h1 class="text-white fw-bold" style="margin-top: 90px; font-size: 30px;"><?= ucwords($captain['fullname']) ?></h1></li>
                                                <li><h6 class="text" style="color:yellow">PUNONG BARANGAY</h6></li>
                                            </ul>                                                                                                   
                                        </div>
                                        <div class="footer-names text-left">                                                        
                                            <ul>
                                                <h2 class="fw-bold text-white"><u>BARANGAY KAGAWAD</u></h2>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad1['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad2['fullname']) ?></h3></li>                                                
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad4['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad5['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad6['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad7['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad3['fullname']) ?></h3></li>
                                            </ul>                                                       
                                        </div>
                                        <div class="footer-names text-left mt-3">                                                       
                                            <ul>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad8['fullname']) ?></h3></li>
                                                <li><h6 class="fw-bold text-white" style="font-size: 15px;">IPMR</h6></li>
                                                <li><h3 class="fw-bold"><?= ucwords($skchairman['fullname']) ?></h3></li>
                                                <li><h6 class="fw-bold text-white" style="font-size: 15px;">SK Chairman</h6></li>
                                                <li><h3 class="fw-bold"><?= ucwords($sec['fullname']) ?></h3></li>
                                                <li><h6 class="fw-bold text-white" style="font-size: 15px;">Barangay Secretary</h6></li>
                                                <li><h3 class="fw-bold"><?= ucwords($treasurer['fullname']) ?></h3></li>
                                                <li><h6 class="fw-bold text-white" style="font-size: 15px;">Barangay Treasurery</h6></li>
                                            </ul>                                                       
                                        </div>
                                    </div>
							    </div>                                         
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include 'templates/main-footer.php' ?>

		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
    <script>
            function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>