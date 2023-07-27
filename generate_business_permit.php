<?php include 'server/server.php' ?>
<?php 
   include 'model/footer-permit.php' 
?>
<?php

$sql = "SELECT * FROM tblpermit";
$result = $conn->query($sql)->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Business Permit</title>
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
										<div class="card-title">Barangay Business Permit</div>
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
                                            <div class="text-center" style="color: white;">
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
                                    <div class="content-letter">
                                        <div class="col-md-12">
                                            <div class="title-header text-center mb-2">
                                                <span class="fw-bold"> BARANGAY</span> <br><span class="fw-bold"> BUSINESS PERMIT</span>
                                            </div>
                                            <?php
                                            $id = $_GET['id'];
                                            $sql = "SELECT * FROM tblpermit WHERE id='$id'";
                                            $result = $conn->query($sql);
                                            $row = $result->fetch_assoc();
                                            ?>
                                            <div class="business ml-4">
                                                <span class="ml-5 text-left">Nature of Business: <span class="fw-bold"><?= ucfirst($row['business_name']) ?></span></span><br>
                                                <span class="ml-5 text-left">Proprietor: <span class="fw-bold"><?= ucfirst($row['owner1']) ?></span></span><br>
                                                <span class="ml-5 text-left">Permit Number: <span class="fw-bold"><?= ucfirst($row['permit_number']) ?></span></span><br>
                                                <span class="ml-5 text-left">Address: <span class="fw-bold"><?= ucfirst($row['address']) ?></span></span><br>
                                                <span class="ml-5 text-left">Business Location: <span class="fw-bold"><?= ucfirst($row['location']) ?></span></span><br>
                                                <span class="ml-5 text-left">Status: <span class="fw-bold"><?= ucfirst($row['status']) ?></span></span><br>
                                            </div>
                                            <div class="letter ml-5 text-left mt-3">
                                                <h2 class="mt-3">This permit is being issued subject to existing rules and regulations, provided however, that the necessary fees are paid to the Treasurer of the Barangay as assessed. </h2>
                                                <h2 class="mt-3">This is non-transferable and shall be deemed null and void upon failure by the owner to follow the said rules and regulations set forth by the Local Government Unit of Davao.</h2>
                                                <h2 class="mt-3">Given this <span class="text"><?= date('jS \d\a\y \o\f F, Y') ?></span> at <span><?= ucwords($town) ?></span>, Davao City</h2>
                                            </div>
                                        </div>
                                        <div class="signature text-right mt-5 mr-5">
                                            <h2 class="text-right fw-bold mr-4"><u><?= ucwords($captain['fullname']) ?></u></h2>
                                            <p class="text-right mr-5">PUNONG BARANGAY</p>
                                            <h2 class="fw-bold text-left ml-5"><u><?= ucfirst($row['owner1']) ?></u></h2>
                                            <p class="text-left" style="margin-left: 105px;">OWNER</p>
                                        </div>
                                        <div class="text-left ml-5" style="font-size: 17px;">
                                            <span><i>CTC No.</i>: <b><?= ucfirst($row['community_tax']) ?></b></span><br>
                                            <span><i>Issued On.</i>: <b><?= date('F jS, Y', strtotime($row['issued_on'])); ?></b></span><br>
                                            <span><i>Isuued at.</i>: <b><?= ucfirst($row['issued_at']) ?></b></span><br>
                                            <p class="text-right mr-5" style="font-size: 17px;"><i>Valid until:</i><i><?= date('F j, Y', strtotime($row['validation'])); ?></i></p><br>
                                        </div>

                                        <p class="text-center" style="font-size: 17px; margin-bottom: 210px;"><i>This license, while in force, shall be posted in a conspicuous place in the business premises.</i></p>
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
                                    <input type="datetime" class="form-control" name="date" value="<?= date('Y-m-d H:i:s') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Payment Details(Optional)</label>
                                    <textarea class="form-control" placeholder="Enter Payment Details" name="details">Business Permit</textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" name="name" value="<?= ucfirst($permit['owner1']) ?>">
                            <input type="hidden" class="form-control" name="email" value="<?= ucfirst($permit['email']) ?>">
                            <button type="button" class="btn btn-danger" onclick="goBack()">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
			<?php include 'templates/main-footer.php' ?>
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