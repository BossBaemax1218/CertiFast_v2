<?php 
    include 'server/db_connection.php';

    $query = "SELECT * FROM tblbrgy_info WHERE id='1'";
    $result = $conn->query($query)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="homepage/assets/css/receipt.css">  
	<title>CertiFast Portal</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="content">
				<div class="panel-header" style ="background-color: #E42654">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">Generate Receipt</h2>
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
										<div class="card-title">Certificate Receipt</div>
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
                                                    <div class="text-white text-center">
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
                                    <div class="row mt-4" style="margin-bottom: 300px;">
                                        <table class="body-wrap">
                                                <tbody>
                                                    <tr>
                                                    <td></td>
                                                    <td class="container" width="600">
                                                        <div class="content-card">
                                                            <table class="main" width="100%" cellpadding="0" cellspacing="0">
                                                                <tbody><tr>
                                                                    <td class="content-wrap aligncenter">
                                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                                            <tbody><tr>
                                                                                <td class="content-block">
                                                                                    <h2>CertiFast Receipt</h2>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="content-block">
                                                                                    <table class="invoice">
                                                                                        <tbody><tr>
                                                                                        <td><label>Anna Smith</label><br>
                                                                                            <label>Invoice: #12345</label><br>
                                                                                            <label>Date: </label>June 01 2015
                                                                                        </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                                                                    <tbody><tr>
                                                                                                        <td>Service 1</td>
                                                                                                        <td class="alignright">$ 20.00</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Service 2</td>
                                                                                                        <td class="alignright">$ 10.00</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Service 3</td>
                                                                                                        <td class="alignright">$ 6.00</td>
                                                                                                    </tr>
                                                                                                    <tr class="total">
                                                                                                        <td class="alignright" width="80%">Total</td>
                                                                                                        <td class="alignright">$ 36.00</td>
                                                                                                    </tr>
                                                                                                </tbody></table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody></table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="content-block">
                                                                                
                                                                                </td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                            <div class="footer-card">
                                                                <table width="100%">
                                                                    <tbody><tr>
                                                                        <td class="aligncenter content-block">Questions? Email <a href="mailto:">support@company.inc</a></td>
                                                                    </tr>
                                                                </tbody></table>
                                                            </div></div>
                                                        </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
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
                                    <input type="datetime" class="form-control" name="date" value="<?= date('Y-m-d H:i:s') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Payment Details(Optional)</label>
                                    <textarea class="form-control" placeholder="Enter Payment Details" name="details">Barangay Clearance</textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="name" value="<?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?>">
                            <input type="hidden" name="email" value="<?= ucwords($resident['email']) ?>">
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