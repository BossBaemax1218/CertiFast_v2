<?php include 'server/server.php' ?>
<?php 
    $id = $_GET['id'];
	$query = "SELECT * FROM tblresident WHERE id='$id'";
    $result = $conn->query($query);
    $resident = $result->fetch_assoc();

    $c = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Kapitan'";
    $captain = $conn->query($c)->fetch_assoc();
    $s = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Secretary'";
    $sec = $conn->query($s)->fetch_assoc();
    $t = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Treasurer'";
    $treasurer = $conn->query($t)->fetch_assoc();
    $skc = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='SK Chairman'";
    $skchairman = $conn->query($skc)->fetch_assoc();
    $k1 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='41'";
    $kagawad1 = $conn->query($k1)->fetch_assoc();
    $k2 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='42'";
    $kagawad2 = $conn->query($k2)->fetch_assoc();
    $k3 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='43'";
    $kagawad3 = $conn->query($k3)->fetch_assoc();
    $k4 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='44'";
    $kagawad4 = $conn->query($k4)->fetch_assoc();
    $k5 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='45'";
    $kagawad5 = $conn->query($k5)->fetch_assoc();
    $k6 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='46'";
    $kagawad6 = $conn->query($k6)->fetch_assoc();
    $k7 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='47'";
    $kagawad7 = $conn->query($k7)->fetch_assoc();
    $k8 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='48'";
    $kagawad8 = $conn->query($k8)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Generate Resident Profile</title>
    <style>
        .card-footer{
            margin-top:275px;
            
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
												Print Certificate
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
                                                            <h3><i class="fas fa-phone" style="color: yellow;"></i> <?= $number ?> &nbsp  <i class="fa fa-envelope" style="color: yellow;"></i> <?= $b_email ?></h3>
                                                        </div>
                                                    <div class="text-center">
                                                        <img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid" width="150">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="row mt-4">
                                        <div class="col-md-3">
                                            <div class="text-center">
                                                <img src="<?= preg_match('/data:image/i', $resident['picture']) ? $resident['picture'] : 'assets/uploads/resident_profile/'.$resident['picture'] ?>" alt="Resident Profile" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <h2 class="mt-8 mt-sm-2 text-left">National ID:</h2>                                                       
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <h3 type="text" class="fw-bold" style="font-size:20px"><?= $resident['national_id'] ?></h3>
                                                    </div>

                                                    <div class="row">
                                                        <h3 class="mt-5 mt-sm-2 text-left">Name:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <h3 type="text" class="fw-bold" style="font-size:20px"> <?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?></h3>
                                                    </div>
                                                    <div class=" row">
                                                        <h3 class="mt-5 mt-sm-2 text-left">Status:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <h3 type="text" class="fw-bold" style="font-size:20px"><?= $resident['resident_type']==1 ? 'Alive' : 'Deceased' ?></h3>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                  <div class="row">
                                                        <h3 class="mt-5 mt-sm-2 text-left">Address:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <h3 type="text" class="fw-bold" style="font-size:20px"><?= $resident['alias'] ?></h3>
                                                    </div>
                                                    <div class=" row">
                                                        <h3 class="mt-5 mt-sm-2 text-left">Birthdate:</h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <h3 type="text" class="fw-bold" style="font-size:20px"><?= date('F d, Y', strtotime($resident['birthdate'])) ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class=" row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Age:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <h3 type="text" class="fw-bold" style="font-size:20px"><?= $resident['age'] ?></h3>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class=" row">
                                                <h3 class="mt-5 col-lg-6 col-md-8 col-sm-2 mt-sm-2 text-left">Civil Status:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <h3 type="text" class="fw-bold" style="font-size:20px"><?= $resident['civilstatus'] ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class=" row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Gender:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <h3 type="text" class="fw-bold" style="font-size:20px"><?= $resident['gender'] ?></h3>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class=" row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Purok:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <h3 type="text" class="fw-bold" style="font-size:20px"><?= $resident['purok'] ?></h3>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Voters:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                            <h3 type="text" class="fw-bold" style="font-size:20px"><?= $resident['voterstatus'] ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class=" row">
                                                <h3 class="mt-5 col-lg-6 col-md-8 col-sm-2 mt-sm-2 text-left">Identified as:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                            <h3 type="text" class="fw-bold" style="font-size:20px"><?= $resident['identified_as'] ?></h3>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <h3 class="mt-5 col-lg-6 col-md-8 col-sm-2 mt-sm-2 text-left">Phone number:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <h3 type="text" class="fw-bold" style="font-size:20px"><?= $resident['phone'] ?></h3>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <h3 class="mt-5 col-lg-6 col-md-8 col-sm-2 mt-sm-2 text-left">Tax Number:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <h3 type="text" class="fw-bold" style="font-size:20px"><?= $resident['email'] ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Occupation:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                            <h3 type="text" class="fw-bold" style="font-size:20px" row="3"><?= ucwords(trim($resident['occupation'])) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Remarks:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <h3 type="text" class="fw-bold" style="font-size:20px" row="3"><?= ucwords(trim($resident['address'])) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <h3 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left">Purpose:</h3>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                            <h3 type="text" class="fw-bold" style="font-size:20px" rows="3"><?= ucwords(trim($resident['remarks'])) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap justify-content-around">  
                                        <div class="card-body" style="background-color:forestgreen; margin-top: 380px;">
                                            <div class="col-md-12 text-left" style="width:100%;max-width:400px; margin: 90px 0px 100px 20px;">
                                                <h1 class="fw-bold" style="color:white; margin: 0px;"><?= ucwords($captain['name']) ?></h1>
                                                <h6 class="text" style="color:yellow; margin: 0px;">PUNONG BARANGAY</h6>
                                            </div>
                                            <div class="col-md-4" style="margin: -250px 200px 510px 400px;">
                                                <h2 class="fw-bold" style="color:white;"><u>Barangay Kagawad</u></h2>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad1['name']) ?></h3>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad2['name']) ?></h3>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad3['name']) ?></h3>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad4['name']) ?></h3>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad5['name']) ?></h3>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad6['name']) ?></h3>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad7['name']) ?></h3>
                                            </div>
                                            <div class="col-md-4" style="margin: -700px 0px 20px 750px;">
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad8['name']) ?></h3>
                                                <h6 class="text" style="color:white; margin: 0px;">IPMR</h6>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($skchairman['name']) ?></h3>
                                                <h6 class="text" style="color:white; margin: 0px;">SK Chairman</h6>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($sec['name']) ?></h3>
                                                <h6 class="text" style="color:white; margin: 0px;">Barangay Secretary</h6>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($treasurer['name']) ?></h3>
                                                <h6 class="text" style="color:white; margin: 0px;">Barangay Treasurery</h6>
                                            </div>
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