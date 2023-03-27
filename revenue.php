<?php include 'server/server.php' ?>
<?php 
	$sql = "SELECT * FROM tblpayments ORDER BY `date` DESC";
    $result = $conn->query($sql);

    $revenue = array();
	while($row = $result->fetch_assoc()){
		$revenue[] = $row; 
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<link rel="stylesheet" href="assets/js/plugin/dataTables.dateTime.min.css">
	<link rel="stylesheet" href="assets/js/plugin/datatables/Buttons-1.6.1/css/buttons.dataTables.min.css">
	<title>Barangay Revenues</title>
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
								<h2 class="text-white fw-bold">Barangay Revenues</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-8">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Revenue Informations</div>
									</div>
								</div>
								<div class="card-body">
									<div class="row mb-3 w-50" style="center: 100px;">
										<div class="col">
											<label>Minimum Date</label>
											<input type="text" class="form-control" placeholder="Enter Date" id="min">
										</div>
										<div class="col">
											<label>Maximum Date</label>
											<input type="text" class="form-control" placeholder="Enter Date" id="max">
										</div>
									</div>
									<div class="col">
										<a id="csv" class="dt-button buttons-csv" style="color: black; margin:-39px 60px">
											<span>Excel</span>
										</a>
										<a id="pdf" class="dt-button button-pdf" style="color: black; margin:-39px -55px">
											<span>Pdf</span>
										</a>
										<a id="txt" class="dt-button buttons-text" style="color: black; margin:-39px 60px">
											<span>Text</span>
										</a>
                                    </div>
									<div class="table-responsive">
										<table id="revenuetable" class="table">
											<thead>
												<tr>
													<th scope="col">Date</th>
													<th scope="col">Recipient</th>
													<th scope="col">Details</th>
													<th scope="col">Amount</th>
													<th scope="col">Username</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($revenue)): ?>
													<?php $no=1; foreach($revenue as $row): ?>
													<tr>
														<td><?= $row['date'] ?></td>
														<td><?= $row['name'] ?></td>
														<td><?= $row['details'] ?></td>
														<td> ₱ <?= number_format($row['amounts'],2) ?></td>
														<td><?= $row['user'] ?></td>
													</tr>
													<?php $no++; endforeach ?>
												<?php endif ?>
											</tbody>
										</table>
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
		var minDate, maxDate;

		$.fn.dataTable.ext.search.push(
			function( settings, data, dataIndex ) {
				var min = minDate.val();
				var max = maxDate.val();
				var date = new Date( data[0] );
		
				if (
					( min === null && max === null ) ||
					( min === null && date <= max ) ||
					( min <= date   && max === null ) ||
					( min <= date   && date <= max )
				) {
					return true;
				}
				return false;
			}
		);
        $(document).ready(function() {

			 minDate = new DateTime($('#min'), {
				format: 'MMMM Do YYYY'
			});
			maxDate = new DateTime($('#max'), {
				format: 'MMMM Do YYYY'
			});

            var table = $('#revenuetable').DataTable({
				"order": [[ 0, "desc" ]],
				dom: 'Bfrtip',
				buttons: [
					{extend: 'print'}
					
				]
				});


			$('#min, #max').on('change', function () {
				table.draw();
			});
        });
    </script>
	<script>
      $("#csv").on("click", function () {
        $("#revenuetable").tableHTMLExport({ type: "csv", filename: "Revenue.csv" });
      });
      $("#pdf").on("click", function () {
        $("#revenuetable").tableHTMLExport({ type: "pdf", filename: "Revenue.pdf" });
      });
      $("#txt").on("click", function () {
        $("#revenuetable").tableHTMLExport({ type: "txt", filename: "Revenue.txt" });
      });
    </script>
</body>
</html>