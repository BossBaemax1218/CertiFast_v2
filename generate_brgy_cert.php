<?php include 'server/server.php' ?>
<?php 
    $id = $_GET['id'];
	$query = "SELECT * FROM tblresident WHERE id='$id'";
    $result = $conn->query($query);
    $resident = $result->fetch_assoc();

    $query1 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position NOT IN ('SK Chairrman','Secretary','Treasurer')
                AND `status`='Active'";
    $result1 = $conn->query($query1);
    $officials = array();
	while($row = $result1->fetch_assoc()){
		$officials[] = $row; 
	}

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
	<title>Barangay Certificate</title>
    <style>
        @page  
        { 
            size: auto;   /* auto is the initial value */ 
            /* this affects the margin in the printer settings */           
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
								<h2 class="text-white fw-bold">Generate Certificate</h2>
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
										<div class="card-title">Barangay Certificate</div>
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
                                    <div class="row mt-4" style="color: black; margin: 50px 10px 50px 50px;">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <h1 class="mt-4 fw-bold mb-5" style="font-size:90px;color:black"> CERTIFICATE OF CLEARANCE </h1>
                                            </div>
                                            <h2 class="mt-5 fw-bold">TO WHOM IT MAY CONCERN:</h2>
                                            <h2 class="mt-3" style="text-indent: 60px;">This is to certify that per records now existing in this office  <span class="fw-bold" style="font: size 23px;px"><?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?></span>, 
                                            of legal age, and a resident of <span class="fw-text" style="font-size:23px"><?= ucwords($town) ?></span>, Davao City, Philippines with 
                                            Community Tax Certificate No.<span class="fw-bold" style="font-size:23px"><?= ucwords($resident['email']) ?></span>  issued on <span class="fw-bold" style="font-size:23px"><?= date('F d, Y') ?></span> 
                                            at Davao City has not been convicted of any Crime, Criminal, Civil nor there is any pending case filed against him/her.</h2> <h2 class="mt-3" style="text-indent: 60px;">This certification is issued upon the request of the 
                                            aforementioned for <span class="fw-bold" style="font-size:23px"><?= ucwords($resident['remarks']) ?></span> or for whatever legal purpose/s that may serve her/him best.</h2>
                                            <h2 class="mt-4" style="text-indent: 60px;"> Done this <span class="fw-bold" style="font-size:23px"><?= date('jS F, Y') ?></span> at <span class="fw-text" style="font-size:23px"><?= ucwords($town) ?>
                                            </span>, Davao City.</h2>
                                        </div>
                                        <div class="col-md-12" style="color: black; margin: 100px 0px 0px 0px;">
                                            <div class="p-3 text-right mr-6">
                                                <h2 class="fw-bold mb-0"><u><?= ucwords($captain['name']) ?></u></h2>
                                                <p class="text-right" style="margin: 0px 20px 10px 0px;">PUNONG BARANGAY</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap justify-content-around">
                                        <div class="card-body" style="background-color:forestgreen; margin-top: 200px;">
                                            <div class="col-md-8 text-left" style="margin: 80px 80px 80px 10px;">
                                                <h1 class="fw-bold" style="color:white;"><?= ucwords($captain['name']) ?></h1>
                                                <h6 class="text" style="color:yellow; margin: 0px;">PUNONG BARANGAY</h6>
                                            </div>
                                            <div class="col-md-4" style="margin: -220px 250px 500px 400px;">
                                                <h2 class="fw-bold" style="color:white;"><u>Barangay Kagawad</u></h2>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad1['name']) ?></h3>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad2['name']) ?></h3>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad3['name']) ?></h3>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad4['name']) ?></h3>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad5['name']) ?></h3>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad6['name']) ?></h3>
                                                <h3 class="fw-bold" style="color:yellow; margin: 0px;"><?= ucwords($kagawad7['name']) ?></h3>
                                            </div>
                                            <div class="col-md-4" style="margin: -700px 0px 10px 700px;">
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

            <!-- Modal -->
            <div class="modal fade" id="pment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_pment.php" >
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="amount" placeholder="Enter amount to pay" required>
                                </div>
                                <div class="form-group">
                                    <label>Date Issued</label>
                                    <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Payment Details(Optional)</label>
                                    <textarea class="form-control" placeholder="Enter Payment Details" name="details">Barangay Clearance Payment</textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="name" value="<?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?>">
                            <button type="button" class="btn btn-secondary" onclick="goBack()">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			<?php if(!isset($_GET['closeModal'])){ ?>
            
                <script>
                    setTimeout(function(){ openModal(); }, 1000);
                </script>
            <?php } ?>
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
    <script>
            function openModal(){
                $('#pment').modal('show');
            }

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