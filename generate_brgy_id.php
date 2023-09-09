<?php include 'server/server.php' ?>
<?php 
   include 'model/footer.php';
   $id = $_GET['id'];
   $query = "SELECT * FROM tblbrgy_id WHERE brgy_id='$id'";
   $result = $conn->query($query);
   $resident = $result->fetch_assoc();  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="assets/css/brgy-id.css">
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
                                <h1 class="text fw-bold" style="font-size: 50px;"></h1>
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
										<div class="card-title">Barangay Identification</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Certificate
											</button>
										</div>
									</div>
								</div>
								    <div class="card-body" id="printThis">
                                        <div class="content-letter">
                                            <div class="text-center">
                                                <h1 class="mt-4 fw-bold mb-5" style="font-size:100px;">BARANGAY IDENTIFICATION</h1>
                                            </div>
                                            <div class="id-card">
                                                <div class="headers">
                                                    <div class="text-center ml-5">
                                                        <img src="assets/uploads/<?= $city_logo ?>" class="img-fluid mr-2 ml-4 logos">
                                                        <img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid logos">
                                                    </div>
                                                    <div>
                                                        <h3 class="text-center mb-1">Republic of the Philippines</h3>
                                                        <h1 class="text-center fw-bold mb-1">Barangay Los Amigos</h1>
                                                        <h4 class="text-center mb-1">Tugbok District, Davao City</h4>
                                                        <h5 class="text-center">Telephone number: <?= $number ?></h5>
                                                    </div>
                                                </div>
                                                <div class="sub-header">
                                                    <h1 class="fw-bold mt-1">BARANGAY IDENTIFICATION CARD</h1>
                                                </div>
                                                <span class="idnumber" style="font-size: 13px">ID No. <?= $resident['id_no'] ?></span>
                                                <div class="namelist">
                                                    <h3 class="fw-bold"><?= ucwords($resident['fullname']) ?></h3>
                                                    <p class="text" style="font-size: 14px">Name</p>
                                                    <h3 class="fw-bold"><?= date('F j, Y', strtotime($resident['birthdate'])) ?></h3>
                                                    <p class="text" style="font-size: 14px">Birthday</p>
                                                    <h3 class="fw-bold mt-2">Purok <?= $resident['purok'] ?>,Barangay Los Amigos,<br>Tugbok District, Davao City, Del Sur, 8000</h3>
                                                    <p class="text" style="font-size: 14px">Address</p>
                                                </div>
                                                <div class="profile-pic mt-3 ml-5"></div>
                                                <hr class="signature-line">
                                                <p class="signature">
                                                    Signature
                                                </p>
                                                <p class="precint">
                                                    Precint No. <strong class="ml-5"><?= $resident['precintno'] ?></strong>
                                                </p>
                                                <hr class="precint-line">
                                                <div class="sub-footer"></div>
                                            </div>   
                                            <div class="id-card mb-5 mt-5" style="color: black;">
                                                <span class="text-left ml-4 mt-5" style="font-size: 16px">In case of emergency, please notify:</span>
                                                <div class="names">
                                                    <h3 class="text" style="font-size: 16px"> <strong>Name:</strong> &nbsp<?= ucwords($resident['guardian']) ?></h3>
                                                    <h3 class="text" style="font-size: 16px"> <strong>Address:</strong> &nbsp Purok <?= $resident['purok'] ?>, Barangay Los Amigos, Tugbok District, Davao City</h3>
                                                    <h3 class="text" style="font-size: 16px"> <strong>Contact Number:</strong> &nbsp <?= $resident['contact_number'] ?></h3>
                                                    <h3 class="text" style="font-size: 16px"> <strong>Relationship:</strong> &nbsp <?= $resident['relationship'] ?></h3>
                                                </div>
                                                <div class="sub-names">
                                                    <h3 class="text-center" style="font-size: 18px"> This is to clarify that the name indicates in this
                                                        identification card <br> is a bona fide resident of 
                                                        Barangay Los Amigos, Tugbok District, Davao City.</h3>
                                                    <h3 class="text-center mt-4"> Issued this <?= date('jS \d\a\y \o\f F, Y') ?></h3>
                                                    <h1 class="fw-bold text-center mt-5" style="color: black;"><?= ucwords($captain['fullname']) ?></h1>
                                                    <h5 class="text-center" style="color: black;">Punong Barangay</h5>
                                                </div>
                                                <div class="sub-footer1"></div>
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
                                    <textarea id="details" name="details" placeholder="Enter Payment Details" class="form-control payment-control btn btn-light btn-info">Barangay Identification</textarea>
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