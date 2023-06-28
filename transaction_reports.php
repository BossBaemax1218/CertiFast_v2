<?php include 'server/server.php' ?>
<?php 
    $query = "SELECT SUM(details) as de FROM tblpayments";
    $revenue1 = $conn->query($query)->fetch_assoc();
    
    $query1 = "SELECT SUM(name) as na FROM tblpayments";
    $revenue2 = $conn->query($query1)->fetch_assoc();

	$query2 = "SELECT SUM(amounts) as am FROM tblpayments ORDER BY `date` DESC";
	$revenue3 = $conn->query($query2)->fetch_assoc();

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
	<title>Transaction Reports</title>
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
								<h1 class="text-center fw-bold" style="font-size: 400%;">Transaction Reports</h1>
							</div>
						</div>
					</div>
				</div>
					<div class="page-inner mt-2">
						<?php if(isset($_SESSION['message'])): ?>
								<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
									<?php echo $_SESSION['message']; ?>
								</div>
							<?php unset($_SESSION['message']); ?>
						<?php endif ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-stats card card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-users fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 13px;">Recipient</h2>
                                                    <h3 class="fw-bold text-uppercase" style="font-size: 45px; color: #C77C8D;"><?= number_format($revenue2['na']) ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="revenue.php?state=all" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-stats card card-round" >
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fa-solid fa-peso-sign fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 13px;">Earnings</h2>
                                                    <h3 class="fw-bold" style="font-size: 45px; color: #C77C8D;"><span>&#8369;</span><?= number_format($revenue3['am'])?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="revenue.php?state=revenue" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-bell fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 13px;">Paid</h2>
                                                    <h3 class="fw-bold text-uppercase" style="font-size: 45px; color: #C77C8D;"><?= number_format($revenue1['de']) ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="purok_info.php?state=purok" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
					    </div>
						<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
						<?php endif ?>
					</div>
                    <div class="page-inner">
                        <div class="row mt--2">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Revenue Informations</div>
                                            <?php if(isset($_SESSION['username'])):?>
                                            <div class="card-tools">
                                                <a id="print" class="btn btn-primary btn-border btn-round btn-sm">
                                                    <i class="fa fa-file"></i>
                                                    Print
                                                </a>
                                                <a id="pdf" class="btn btn-primary btn-border btn-round btn-sm">
                                                    <i class="fa fa-file"></i>
                                                    Pdf
                                                </a>
                                                <a id="txt" class="btn btn-primary btn-border btn-round btn-sm">
                                                    <i class="fa fa-file"></i>
                                                    Text
                                                </a>
                                                <a id="csv" class="btn btn-primary btn-border btn-round btn-sm">
                                                    <i class="fa fa-file"></i>
                                                    Excel
                                                </a>
                                            </div>
                                            <?php endif ?>
                                            </div>
                                        </div>
                                    <div class="card-body">
                                        <div class="row w-100">
                                            <div class="col ml-3">
                                                <input type="text" class="form-control" placeholder="Enter Minimum Date" id="min">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Enter Maximum Date" id="max">
                                            </div>
                                            <div class="col" style="margin-left: 50%">
                                                <input type="text" class="form-control" placeholder="Search" id="search">
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="revenuetable" class="table">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Recipient</th>
                                                        <th scope="col">Details</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Staff</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(!empty($revenue)): ?>
                                                        <?php $no=1; foreach($revenue as $row): ?>
                                                        <tr class="text-center">
                                                            <td><?= $row['date'] ?></td>
                                                            <td><?= $row['name'] ?></td>
                                                            <td><?= $row['details'] ?></td>
                                                            <td> <i class="fa-solid fa-peso-sign"></i> <?= number_format($row['amounts'],2) ?></td>
                                                            <td><?= $row['user'] ?></td>
                                                            <td>
                                                            <div class="form-button-action">
                                                                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
                                                                <a type="button" data-toggle="tooltip" href="generate_receipt.php?id=<?= $row['id'] ?>" class="btn btn-link btn-info" data-original-title="Generate">
                                                                    <i class="fas fa-print"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_payment.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this data?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                <?php endif ?>
                                                            </div>
                                                            </td>
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
				<?php include 'templates/main-footer.php' ?>
	        </div>
	    </div>
	<?php include 'templates/footer.php' ?>
<script>
$(document).ready(function() {
  // Search function
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();

    // Loop through each row in the table body
    $("#revenuetable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });

  $(".datepicker").datepicker({
    dateFormat: "yy-mm-dd" // Customize date format if needed
  });

  // Attach event listener for min and max input changes
  $("#min, #max").on("change", function() {
    var minDate = new Date($("#min").val());
    var maxDate = new Date($("#max").val());

    // Loop through each row in the table body
    $("#revenuetable tbody tr").each(function() {
      var rowDate = new Date($(this).find("td:first-child").text());

      // Show/hide rows based on the min and max date
      if (rowDate >= minDate && rowDate <= maxDate) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  $("#csv").on("click", function() {
    console.log("Exporting revenue table as CSV...");
    $("#revenuetable").tableHTMLExport({ type: "csv", filename: "Revenue.csv" });
  });

  $("#pdf").on("click", function() {
    console.log("Exporting revenue table as PDF...");
    $("#revenuetable").tableHTMLExport({ type: "pdf", filename: "Revenue.pdf" });
  });

  $("#txt").on("click", function() {
    console.log("Exporting revenue table as TXT...");
    $("#revenuetable").tableHTMLExport({ type: "txt", filename: "Revenue.txt" });
  });

  $("#print").on("click", function() {
    console.log("Printing revenue table...");
    var printContents = $(".table-responsive").html();
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  });
});

</script>
</body>
</html>