<?php include 'server/server.php' ?>
<?php 
   include 'model/footer.php';
$id = $_GET['id'];
$query = "SELECT * FROM tbloath WHERE oath_id='$id'";
$result = $conn->query($query);
$resident = $result->fetch_assoc(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>CertiFast Portal</title>
    <link rel="stylesheet" href="assets/css/payment-style.css">
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="container mt-5">
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
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
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
                                            <div class="header d-flex flex-wrap justify-content-around">
                                                <div class="text-center">
                                                    <h1 class="fw-bold mb-1">Republic of the Philippines</h1>
                                                    <h1 class="fw-bold mb-1">City of <?= ucwords($province) ?></h1>
                                                    <h1 class="fw-bold mb-1"  style="font-size: 40px;"><?= ucfirst($brgy) ?></i></h1>
                                                    <h2 class="fw-bold mb-2" style="font-size: 22px;"><?= ucwords($town) ?></h2>				
                                                    <h2 style="font-size: 20px;"><i class="fas fa-phone" style="color: yellow;"></i> <span class="fw-bold"><?= $number ?></span>  &nbsp  <i class="fw-bold fa fa-envelope" style="color: yellow;"></i> <span class="fw-bold"><?= $b_email ?></span> </h2>
                                                </div>
                                            <div class="text-center mt-4">
                                                <img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid mr-4" width="150">
                                                <img src="assets/uploads/<?= $city_logo ?>" class="img-fluid" width="150">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="content-letter">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <h1 class="mt-3 fw-bold mb-4" style="font-size:70px;"><u>OATH OF UNDERTAKING</u></h1>
                                            </div>
                                            <h3 class="mt-4 text-justify" style="text-indent: 60px;">
                                                I, <span class="fw-bold"><?= ucwords($resident['fullname']) ?></span>, 
                                                <?= ucwords($resident['age']) ?> years old, resident of
                                                <span class="text"> Purok <?= ucwords($resident['purok']) ?></span>, 
                                                Barangay Los Amigos, Tugbok District, Davao City, for 10 year/s, availing the benefits of Republic Act 11261,
                                                otherwise otherwise known as the First Time Jobseekers Act of 2019, do hereby declare, agree and undertake to abide and be bounded by the following:
                                                <ol class="mt-4">
                                                    <li>1. That this is the first time that I will actively look for a job, and therefore requesting that a Barangay Certification be issued in my favor to avail the benefits of the law;</li>
                                                    <li>2. That I am aware that the benefit and privilege/s under the said law shall be valid only for one (1) year from that date that the Barangay Certification is issued;</li>
                                                    <li>3. That I can avail the benefits of the law only once;</li>
                                                    <li>4. That I understand that my personal information shall be included in the Roster/List of First Time Jobseekers and will not be used for any unlawful purpose;</li>
                                                    <li>5. That I will inform and/or report to the Barangay personally, through text or other means, or through my family/relatives once I get employed; and</li>
                                                    <li>6. That I am not a beneficiary for the JobStart Program under R.A. No. 10869 and other laws that give similar exemptions for the documents or transactions exempted under R.A. No. 11261</li>
                                                    <li>7. That if issued the request Certification, I will not use the same in any fraud, neither falsify nor help and/or assist in the fabrication of the said certification.</li>
                                                    <li>8. That this undertaking is made solely for the purpose of obtaining a Barangay Certification consistent with the objective of R.A. No. 11261 and not for any other purpose.</li>
                                                    <li>9. That I consent to the use of my personal information pursuant to the Data Privacy and other applicable laws, rules, and regulations.</li>
                                                </ol>
                                            </h3>
                                            <h3 class="mt-3 text-justify">
                                                Signed this <span class="fw-bold" style="text-indent: 60px;"><?= date('jS \d\a\y \o\f F, Y') ?></span> 
                                                in the City of Davao.
                                            </h3>
                                        </div>
                                        <div class="col-md-12 text-right" style="margin-top: 10px;">
                                            <div class="p-3 text" style="font-size: 15px; margin-bottom: 200px;">
                                                <ol>
                                                    <li class="fw-bold text" style="font-size: 20px; text-align: right;"><span class="fw-bold"><?= ucwords($resident['fullname']) ?></span></li>
                                                    <li class="text" style="margin-right: 42px;">First Time Jobseeker</li>
                                                    <li class="text" style="margin-right: 34px;">Date: <span class="fw-bold"><?= date('F j, Y') ?></span></li>
                                                    <li class="fw-bold text mt-3 mb-3" style="margin-right: 81px;">Witnessed By:</li>
                                                    <li class="fw-bold" style="font-size: 20px;"><?= ucwords($captain['fullname']) ?></li>
                                                    <li class="text" style="margin-right: 58px;">Punong Barangay</li>
                                                    <li class="text" style="margin-right: 32px;">Date: <span class="fw-bold"><?= date('F j, Y') ?></span></li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer-content">
                                        <div class="footer-names text-left">                                                       
                                            <ul>
                                                <li><h1 class="fw-bold" style="font-size: 30px; margin-top: 90px; color:white"><?= ucwords($captain['fullname']) ?></h1></li>
                                                <li><h4 class="text" style="color:yellow">PUNONG BARANGAY</h4></li>
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
            <!-- Modal -->
            <div class="modal fade" id="pment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_pment.php">
                                <div class="form-group">
                                    <label for="name">Payeer Name</label>
                                    <input type="text" id="name" name="name" value="<?= $resident['requester'] ?>" class="form-control payment-control btn btn-light btn-info">
                                </div>
                                <div class="form-group">
                                    <label for="payment-details">Payment Details</label>
                                    <textarea id="details" name="details" placeholder="Enter Payment Details" class="form-control payment-control btn btn-light btn-info">Certificate of Oath Taking</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="date-issued">Date Issued</label>
                                    <input type="datetime" id="date-issued" name="date" value="<?= date('Y-m-d') ?>" class="form-control payment-control btn btn-light btn-info">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Copies</label>
                                    <input type="number" id="quantity" name="quantity" value="<?= $resident['quantity'] ?>" class="form-control payment-control btn btn-light btn-info">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" id="price" name="price" placeholder="0.00" class="form-control payment-control btn btn-light btn-info" required>
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold total-amount-label">Total Amount:</label>
                                    <input id="amount" name="amount" class="total-amount-value" value="₱ 0.00" style="border: none; background-color: transparent;">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="email" value="<?= $resident['email'] ?>">
                                <input type="hidden" name="requirement" value="<?= $resident['requirement'] ?>">
                                <button type="button" class="btn btn-danger" onclick="goBack()" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Confirm and Pay</button>
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
    document.addEventListener("DOMContentLoaded", function () {
        var quantityInput = document.getElementById("quantity");
        var amountInput = document.getElementById("price");
        var totalAmountInput = document.getElementById("amount");

        function updateTotal() {
            var quantity = parseFloat(quantityInput.value) || 0;
            var amount = parseFloat(amountInput.value) || 0;
            var total = quantity * amount;
            totalAmountInput.value = "₱ " + total.toFixed(2);
        }

        quantityInput.addEventListener("input", updateTotal);
        amountInput.addEventListener("input", updateTotal);
    });
</script>
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