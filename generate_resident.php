<?php include 'server/server.php' ?>
<?php 
    $id = $_GET['id'];
	$query = "SELECT * FROM tblresident WHERE id='$id'";
    $result = $conn->query($query);
    $resident = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Generate Resident Profile</title>
    <style>
        .card-footer{
            margin-top:30px;
            
        }
    </style>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<!-- Main Header -->
		<?php include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header" style = "background-color: #E42654">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">Generate Resident Profile</h2>
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
												Print Report
											</button>
										</div>
									</div>
								</div>
								<div class="card-body" id="printThis">
                                    <div class="card-header" style="background-color:forestgreen;">
                                            <div class="card-head">
                                                <div class="d-flex flex-wrap justify-content-around">
                                                    <div class="text-center">
                                                        <img src="assets/uploads/<?= $city_logo ?>" class="img-fluid" width="150">
                                                    </div>
                                                        <div class="text-center" style="color: white;">
                                                            <h2 class="mb-1">Republic of the Philippines</h2>
                                                            <h2 class="mb-1">City of <?= ucwords($province) ?></h2>
                                                            <h1 class="fw-bold mb-1"><?= ucwords($brgy) ?></i></h1>
                                                            <h3 class="mb-2"><?= ucwords($town) ?></h3>				
                                                            <h3><i class="fas fa-phone"> <?= $number ?> &nbsp </i> <i class="fa fa-envelope"> <?= $b_email ?></i></h3>
                                                        </div>
                                                    <div class="text-center">
                                                        <img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid" width="150">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <div class="text-center p-1" style="border:1px solid red">
                                                <img src="<?= preg_match('/data:image/i', $resident['picture']) ? $resident['picture'] : 'assets/uploads/resident_profile/'.$resident['picture'] ?>" alt="Resident Profile" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">National ID:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['national_id'] ?>">
                                                    </div>

                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Name:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Status:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['resident_type']==1 ? 'Alive' : 'Deceased' ?>">
                                                    </div>

                                                    <div class="form-group row">
                                                        <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Address:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['alias'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Birthdate:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= date('F d, Y', strtotime($resident['birthdate'])) ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Age:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['age'] ?> yrs. old">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <h3 class="mt-5 col-lg-6 col-md-8 col-sm-2 mt-sm-2 text-left">Civil Status:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['civilstatus'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Gender:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['gender'] ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Purok:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['purok'] ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Voters:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['voterstatus'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <h3 class="mt-5 col-lg-6 col-md-8 col-sm-2 mt-sm-2 text-left">Identified as:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['identified_as'] ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <h3 class="mt-5 col-lg-6 col-md-8 col-sm-2 mt-sm-2 text-left">Phone number:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['phone'] ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <h3 class="mt-5 col-lg-6 col-md-8 col-sm-2 mt-sm-2 text-left">Tax Number:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                            <input type="text" class="form-control fw-bold" style="font-size:20px" value="<?= $resident['email'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Occupation:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <textarea class="form-control fw-bold" style="font-size:20px" rows="3"><?= ucwords(trim($resident['occupation'])) ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Remarks:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <textarea class="form-control fw-bold" style="font-size:20px" rows="3"><?= ucwords(trim($resident['address'])) ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Purpose:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <textarea class="form-control fw-bold" style="font-size:20px" rows="3"><?= ucwords(trim($resident['remarks'])) ?></textarea>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="card-footer" style="background-color:forestgreen;">
                                        <div class="col-md-12 text-left" style="margin: 90px 0px 100px 20px;">
                                            <h1 class="fw-bold" style="color:white; margin: 0px;">Roberto A. Ballarta</h1>
                                            <h6 class="text" style="color:yellow; margin: 0px;">PUNONG BARANGAY</h6>
                                        </div>
                                        <div class="col-md-4" style="margin: -250px 200px 510px 400px;">
                                            <h2 class="fw-bold" style="color:white;"><u>Barangay Kagawad</u></h2>
                                            <h3 class="fw-bold" style="color:yellow; margin: 0px;">Aileen C. Natino</h3>
                                            <h3 class="fw-bold" style="color:yellow; margin: 0px;">Ruel C. Ceballos</h3>
                                            <h3 class="fw-bold" style="color:yellow; margin: 0px;">Angelico T. Santander, Jr.</h3>
                                            <h3 class="fw-bold" style="color:yellow; margin: 0px;">Ann Liezl G. Deliquiña</h3>
                                            <h3 class="fw-bold" style="color:yellow; margin: 0px;">Raymund P. Pupa</h3>
                                            <h3 class="fw-bold" style="color:yellow; margin: 0px;">Adonis J. Satander</h3>
                                            <h3 class="fw-bold" style="color:yellow; margin: 0px;">Loudel B. Concon</h3>
                                        </div>
                                        <div class="col-md-4" style="margin: -700px 0px 20px 750px;">
                                            <h3 class="fw-bold" style="color:yellow; margin: 0px;">Arlene D. Suaybaguio</h3>
                                            <h6 class="text" style="color:white; margin: 0px;">IPMR</h6>
                                            <h3 class="fw-bold" style="color:yellow; margin: 0px;">Rowen E. Sampadong </h3>
                                            <h6 class="text" style="color:white; margin: 0px;">SK Chairman</h6>
                                            <h3 class="fw-bold" style="color:yellow; margin: 0px;">Abbie Charlotte C. Sarsale</h3>
                                            <h6 class="text" style="color:white; margin: 0px;">Barangay Secretary</h6>
                                            <h3 class="fw-bold" style="color:yellow; margin: 0px;">Melizza Jolie B. Tañac</h3>
                                            <h6 class="text" style="color:white; margin: 0px;">Barangay Treasurery</h6>
                                        </div>
							        </div>
							    </div>                                         
								</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
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