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

    $c = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Captain'";
    $captain = $conn->query($c)->fetch_assoc();
    $s = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Secretary'";
    $sec = $conn->query($s)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Certificate of Indigency</title>
    <style>
        @page  
        { 
            size: auto;   /* auto is the initial value */ 

            /* this affects the margin in the printer settings */  
        } 
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
										<div class="card-title">Certificate of Indigency</div>
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
                                                        <h3><i class="fas fa-phone"> <?= $number ?> &nbsp </i> <i class="fa fa-envelope"> <?= $b_email ?></i></h3>
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
                                                <h1 class="mt-4 fw-bold mb-5" style="font-size:90px;color:black">BARANGAY CERTIFICATION</h1>
                                            </div>
                                            <h2 class="mt-5 fw-bold">TO WHOM IT MAY CONCERN:</h2>
                                            <h2 class="mt-3" style="text-indent: 40px;">This is to certify that <span class="fw-bold" style="font-size:25px"><?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?></span>, 
                                            of legal age, and is a bona fide resident of <span class="fw-bold" style="font-size:20px"> Purok <?= ucwords($resident['purok']) ?></span>, <span class="fw-bold" style="font-size:20px"><?= ucwords($town) ?></span>, Davao City.
                                            <h2 class="mt-3" style="text-indent: 40px;">This further certifies that the above mentioned belongs to an indigent family in this Barangay.</h2>
                                            <h2 class="mt-3" style="text-indent: 40px;">This certification is issued upon the request of aforementioned for <span class="fw-bold" style="font-size:20px"><?= ucwords($resident['remarks']) ?></span> 
                                            or for whatever legal purpose/s that may serve her/him best. </h2> <h2 class="mt-3" style="text-indent: 40px;">Done this <span class="fw-bold" style="font-size:20px">
                                            <?= date('jS F, Y') ?></span> at <span class="fw-text" style="font-size:20px"><?= ucwords($town) ?></span>, Davao City.</h2>    
                                        </div>
                                        <div class="col-md-12" style="color: black; margin: 100px 0px 0px 0px;">
                                            <div class="p-3 text-right mr-6">
                                                <h2 class="fw-bold mb-0"><u><?= ucwords($captain['name']) ?></u></h2>
                                                <p class="text-right" style="margin: 0px 20px 10px 0px;">PUNONG BARANGAY</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer" style="background-color:forestgreen;">
                                        <div class="col-md-12 text-left" style="margin: 90px 0px 100px 20px;">
                                            <h1 class="fw-bold" style="color:white; margin: 0px;"><?= ucwords($captain['name']) ?></h1>
                                            <h6 class="text" style="color:yellow; margin: 0px;">PUNONG BARANGAY</h6>
                                        </div>
                                        <div class="col-md-4" style="margin: -250px 200px 510px 400px;">
                                            <h2 class="fw-bold" style="color:white;"><u>Barangay Kagawad</u></h2>
                                            <h3 class="fw-bold" style="color:yellow; margin: auto;">Aileen C. Natino</h3>
                                            <h3 class="fw-bold" style="color:yellow; margin: auto;">Ruel C. Ceballos</h3>
                                            <h3 class="fw-bold" style="color:yellow; margin: auto;">Angelico T. Santander, Jr.</h3>
                                            <h3 class="fw-bold" style="color:yellow; margin: auto;">Ann Liezl G. Deliquiña</h3>
                                            <h3 class="fw-bold" style="color:yellow; margin: auto;">Raymund P. Pupa</h3>
                                            <h3 class="fw-bold" style="color:yellow; margin: auto;">Adonis J. Satander</h3>
                                            <h3 class="fw-bold" style="color:yellow; margin: auto;">Loudel B. Concon</h3>
                                        </div>
                                        <div class="col-md-4" style="margin: -700px 0px 20px 750px;">
                                            <h3 class="fw-bold" style="color:yellow; margin: auto;">Arlene D. Suaybaguio</h3>
                                            <h6 class="text" style="color:white; margin: auto;">IPMR</h6>
                                            <h3 class="fw-bold" style="color:yellow; margin: auto;">Rowen E. Sampadong </h3>
                                            <h6 class="text" style="color:white; margin: auto;">SK Chairman</h6>
                                            <h3 class="fw-bold" style="color:yellow; margin: auto;">Abbie Charlotte C. Sarsale</h3>
                                            <h6 class="text" style="color:white; margin: auto;">Barangay Secretary</h6>
                                            <h3 class="fw-bold" style="color:yellow; margin: auto;">Melizza Jolie B. Tañac</h3>
                                            <h6 class="text" style="color:white; margin: auto;">Barangay Treasurery</h6>
                                        </div>
							        </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <!-- Modal -->
           <div class="modal fade" id="pment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
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
                                    <textarea class="form-control" placeholder="Enter Payment Details" name="details">Certificate of Indigency Payment</textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" name="name" value="<?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?>">
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