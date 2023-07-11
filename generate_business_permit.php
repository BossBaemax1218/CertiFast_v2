<?php include 'server/server.php' ?>
<?php 
    $id = $_GET['id'];
	$query = "SELECT * FROM tblpermit WHERE id='$id'";
    $result = $conn->query($query);
    $permit = $result->fetch_assoc();

    $c = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Kapitan'";
    $captain = $conn->query($c)->fetch_assoc();
    $s = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Secretary'";
    $sec = $conn->query($s)->fetch_assoc();
    $t = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Treasurer'";
    $treasurer = $conn->query($t)->fetch_assoc();
    $skc = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='SK Chairman'";
    $skchairman = $conn->query($skc)->fetch_assoc();
    $k1 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='21'";
    $kagawad1 = $conn->query($k1)->fetch_assoc();
    $k2 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='22'";
    $kagawad2 = $conn->query($k2)->fetch_assoc();
    $k3 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='23'";
    $kagawad3 = $conn->query($k3)->fetch_assoc();
    $k4 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='24'";
    $kagawad4 = $conn->query($k4)->fetch_assoc();
    $k5 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='25'";
    $kagawad5 = $conn->query($k5)->fetch_assoc();
    $k6 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='26'";
    $kagawad6 = $conn->query($k6)->fetch_assoc();
    $k7 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='27'";
    $kagawad7 = $conn->query($k7)->fetch_assoc();
    $k8 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblofficials.id='28'";
    $kagawad8 = $conn->query($k8)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Business Permit</title>
    <style>
        .footer-content {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: forestgreen;
        color: white;
        padding: 5px;
        display: flex;
        justify-content: space-between;;
      }
      .footer-names {
        display: inline-block;
      } 
      .text-left {
        text-align: right;  
        margin-right: 2%;
        margin-top: 10px;     
      }

      ul, ol {
        list-style: none;
      }   
      .footer-names .fw-bold {
        margin-top: 10px;
        margin: 0px;
        padding: 0px;
        color: yellow;
    }
    /* Media query for laptops and computers */
    @media (min-width: 992px) {
        .footer-names {
            margin-bottom: 0;
        }

        .personal-info {
            margin-left: 150px;
        }

        .family-info {
            margin-left: 100px;
        }
    }

    /* Media query for phones */
    @media (max-width: 767px) {
        .footer-content {
            flex-direction: column;
        }
        
        .footer-names {
            margin-bottom: 20px;
        }

        .personal-info,
        .family-info {
            margin-left: 0;
        }
    }
    </style>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="content">
				<div class="panel-header" style = "background-color: #E42654">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">Generate Permit</h2>
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
										<div class="card-title">Barangay Business Permit</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Certificate
											</button>
										</div>
									</div>
								</div>
								<div class="card-body m-5" id="printThis">
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
                                    <div class="row mt-2" style="margin-bottom: 200px;">
                                        <div class="col-md-12">
                                            <div class="text-center mt-5">
                                                <h1 class="fw-bold">OFFICE OF THE PUNONG BARANGAY</h1>
                                            </div>
                                            <div class="text-center mt-2">
                                                <h1 class="fw-bold" style="font-size:80px;">BUSINESS PERMIT</h1>
                                            </div>
                                            <h2 class="ml-5 text-left">GRANTED TO:</h2>
                                            <div class="text-center pt-0">
                                                <h1 class="mt-0 fw-bold mb-2" style="font-size:40px;"><?= ucfirst($permit['name']) ?></h1>                                               
                                                <h4 class="mt-0">NAME OF BUSINESS OR ESTABLISHMENT</h4>
                                            </div>
                                            <div class="text-center pt-4 mb-5">
                                                <h1 class="mt-0 fw-bold mb-2" style="font-size:40px;"><?= empty($permit['owner2']) ? $permit['owner1'] : ucwords($permit['owner1'].' & '.$permit['owner2']) ?></h1>
                                                <h4 class="mt-0">OWNER'S NAME</h4>
                                            </div>
                                            <div class="ml-5 text-left">
                                                <h2 class="mt-3" style="text-indent: 40px;">This clearance is granted in accordance with section 152 of R.A. 7160 of Barangay Tax Ordinance, provided however, that the necessary fees are paid to the Barangay Treasurer.</h2>
                                                <h2 class="mt-3" style="text-indent: 40px;">This is non-transferable and shall be deemed null and void upon failure by the owner to follow the said rules and regulations set forth by the Local Government Unit of <span style="font-size:22px"><?= ucwords($town) ?>.</h2>
                                                <h2 class="mt-3">Given this <span class="fw-bold" style="font-size:20px"><?= date('m/d/Y') ?></span> at <span style="font-size:20px"><?= ucwords($brgy.', '.$town) ?></span>.</h2>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <div class="p-3 text-right mr-8">
                                                <h2 class="fw-bold mb-0"><u><?= ucwords($captain['fullname']) ?></u></h2>
                                                <p class="text mr-4">PUNONG BARANGAY</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2 text-left">
                                            <h4 class="ml-4"><i>CTC No.</i>:__________________________</h4>
                                            <h4 class="ml-4"><i>Issued On.</i>:__________________________</h4>
                                            <h4 class="ml-4"><i>Isuued at.</i>: <?= ucwords($brgy.','.$town) ?></h4>
                                            <h4 class="ml-4"><i>OR No.</i>:__________________________</h4>
                                        </div>
                                        <p class="ml-4"><i>(This permit, while in force, shall be posted in a conspicious place in the business premises.)</i></p>
                                    </div>
                                    <div class="footer-content">
                                        <div class="footer-names text-left">                                                       
                                            <ul>
                                                <li><h1 class="fw-bold" style="margin-top: 90px;"><?= ucwords($captain['fullname']) ?></h1></li>
                                                <li><h6 class="text mr-5">PUNONG BARANGAY</h6></li>
                                            </ul>                                                                                                  
                                        </div>
                                        <div class="footer-names text-left">                                                        
                                            <ul>
                                                <h2 class="text-bold"><u>Barangay Kagawad</u></h2>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad1['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad2['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad3['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad4['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad5['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad6['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad7['fullname']) ?></h3></li>
                                            </ul>                                                       
                                        </div>
                                        <div class="footer-names text-left">                                                       
                                            <ul>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad8['fullname']) ?></h3></li>
                                                <li><h6 class="text">IPMR</h6></li>
                                                <li><h3 class="fw-bold"><?= ucwords($skchairman['fullname']) ?></h3></li>
                                                <li><h6 class="text">SK Chairman</h6></li>
                                                <li><h3 class="fw-bold"><?= ucwords($sec['fullname']) ?></h3></li>
                                                <li><h6 class="text">Barangay Secretary</h6></li>
                                                <li><h3 class="fw-bold"><?= ucwords($treasurer['fullname']) ?></h3></li>
                                                <li><h6 class="text">Barangay Treasurery</h6></li>
                                            </ul>                                                       
                                        </div>
                                    </div> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            
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
                            <form method="POST" action="model/save_pment.php">
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
                                    <textarea class="form-control" placeholder="Enter Payment Details" name="details">Business Permit Payment</textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" name="name" value="<?= ucfirst($permit['name']) ?>">
                            <button type="button" class="btn btn-danger" onclick="goBack()">Close</button>
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