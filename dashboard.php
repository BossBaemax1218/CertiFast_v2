<?php include 'server/server.php' ?>
<?php 

	$query = "SELECT * FROM tblresident WHERE resident_type=1";
    $result = $conn->query($query);
	$total = $result->num_rows;

	$query1 = "SELECT * FROM tbl_users WHERE user_type='staff'";
    $result1 = $conn->query($query1);
	$staff = $result1->num_rows;

	$query2 = "SELECT * FROM tblresident WHERE gender='Female' AND resident_type=1";
    $result2 = $conn->query($query2);
	$female = $result2->num_rows;

	$query3 = "SELECT * FROM tblresident WHERE voterstatus='Yes' AND resident_type=1";
    $result3 = $conn->query($query3);
	$totalvoters = $result3->num_rows;

	$query4 = "SELECT * FROM tblresident WHERE voterstatus='No' AND resident_type=1";
	$non = $conn->query($query4)->num_rows;

	$query5 = "SELECT * FROM tblpurok";
	$purok = $conn->query($query5)->num_rows;

	$query8 = "SELECT SUM(amounts) as am FROM tblpayments";
	$revenue = $conn->query($query8)->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<title>Dashboard</title>
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
								<h2 class="text-white fw-bold">Dashboard</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2">
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
												<h2 class="text-uppercase" style="font-size: 13px;">Population</h2>
												<h3 class="fw-bold text-uppercase" style="font-size: 30px; color: #C77C8D;"><?= number_format($total) ?></h3>
											</div>
										</div>
									</div>
									<div class="card-body">
										<a href="resident_info.php?state=all" class="card-link text" style="color: gray;">All Resident </a>
									</div>
								</div>
							</div>
						</div>
						<!--<div class="col-md-4">
							<div class="card card-stats card card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-4">
											<div class="icon-big text-center">
												<i class="fas fa-user fa-2x" style="color: gray;"></i>
											</div>
										</div>
										<div class="col-2 col-stats">
										</div>
										<div class="col-2 col-stats">
											<div class="numbers mt-2">
												<h2 class="text-uppercase" style="font-size: 13px;">Employees</h2>
												<h3 class="fw-bold" style="font-size: 30px; color: #C77C8D;"><?= number_format($staff) ?></h3>
											</div>
										</div>
									</div>
									<div class="card-body">
										<a href="users.php?state=male" class="card-link text" style="color: gray;">All Employees </a>
									</div>
								</div>
							</div>
						</div>-->
						<!--<div class="col-md-3">
							<div class="card card-stats card card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-4">
											<div class="icon-big text-center">
												<i class="fas fa-user-check fa-2x" style="color: gray;"></i>
											</div>
										</div>
										<div class="col-2 col-stats">
										</div>
										<div class="col-2 col-stats">
											<div class="numbers mt-2">
												<h2 class="text-uppercase" style="font-size: 13px;">Voters</h2>
												<h3 class="fw-bold text-uppercase" style="font-size: 30px; color: #D32D41;"><?= number_format($totalvoters) ?></h3>
											</div>
										</div>
									</div>
									<div class="card-body">
										<a href="resident_info.php?state=voters" class="card-link text-" style="color: gray;">Total Voters </a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card card-stats card card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-4">
											<div class="icon-big text-center">
												<i class="fas fa-user-times fa-2x" style="color: gray;"></i>
											</div>
										</div>
										<div class="col-2 col-stats">
										</div>
										<div class="col-2 col-stats">
											<div class="numbers mt-2">
												<h2 class="text-uppercase" style="font-size: 13px;">NonVoters</h2>
												<h3 class="fw-bold text-uppercase" style="font-size: 30px; color: #D32D41;"><?= number_format($non) ?></h3>
											</div>
										</div>
									</div>
									<div class="card-body">
										<a href="resident_info.php?state=non_voters" class="card-link text" style="color: gray;">Total Non-Voters</a>
									</div>
								</div>
							</div>
						</div>-->
						<div class="col-md-4">
							<div class="card card-stats card card-round" >
								<div class="card-body">
									<div class="row">
										<div class="col-4">
											<div class="icon-big text-center">
												<i class="fas fa-chart-bar fa-2x" style="color: gray;"></i>
											</div>
										</div>
										<div class="col-2 col-stats">
										</div>
										<div class="col-2 col-stats">
											<div class="numbers mt-2">
												<h2 class="text-uppercase" style="font-size: 13px;">Earnings</h2>
												<h3 class="fw-bold" style="font-size: 30px; color: #C77C8D;"><span>&#8369;</span><?= number_format($revenue['am'],2)?></h3>
											</div>
										</div>
									</div>
									<div class="card-body">
										<a href="revenue.php?state=revenue" class="card-link text" style="color: gray;">All Earnings </a>
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
												<i class="fas fa-route fa-2x" style="color: gray;"></i>
											</div>
										</div>
										<div class="col-2 col-stats">
										</div>
										<div class="col-2 col-stats">
											<div class="numbers mt-2">
												<h2 class="text-uppercase" style="font-size: 13px;">Purok</h2>
												<h3 class="fw-bold text-uppercase" style="font-size: 30px; color: #C77C8D;"><?= number_format($purok) ?></h3>
											</div>
										</div>
									</div>
									<div class="card-body">
										<a href="purok_info.php?state=purok" class="card-link text" style="color: gray;">Purok Information</a>
									</div>
								</div>
							</div>
						</div>
					 </div>
						<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
						<?php endif ?>
						<div class="row">
							<div class="col-md-3">
								<div class="card card-stats card-round">
									<div class="card-body">
										<canvas id="myChart1" style="width:100%;max-width:400px">
											<script>
												var xValues = ["Total Resident"];
												var yValues = [100,50];
												var barColors = [
												"#D32D41"
												];
												var options = {
													pieceLabel: {
														render: function(d) { return d.label + " (" + d.percentage + "%)" },
														fontColor: '#000',
														position: 'outside',
														segment: true
													}
												};

												new Chart("myChart1", {
												type: "pie",
												data: {
													labels: xValues,
													datasets: [{
													backgroundColor: barColors,
													data: yValues
													}]
												},
												options: {
													title: {
													display: true,
													text: "Overall Total Resident"
													}
												}
												});
											</script>
										</canvas>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card card-stats card-round">
									<div class="card-body">
											<canvas id="myChart" style="width:100%;max-width:800px">
												<script>
													var xValues = ["Jan", "Feb", "Mar", "Apr", "May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
													var yValues = [5, 10, 15, 20,25,30,35,40,45,50,55,60];
													var barColors = ["#D32D41", "#D32D41","#D32D41","#D32D41","#D32D41","#D32D41","#D32D41","#D32D41","#D32D41","#D32D41","#D32D41","#D32D41"];

													new Chart("myChart", {
													type: "bar",
													data: {
														labels: xValues,
														datasets: [{
														backgroundColor: barColors,
														data: yValues
														}]
													},
													options: {
														legend: {display: false},
														title: {
														display: true,
														text: "All Year's Earning's"
														}
													}
													});
												</script>
											</canvas>
									</div>
								</div>
							</div>			
						</div>
					<!--<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title fw-bold">LGU Mission Statement</div>
									</div>
								</div>
								<div class="card-body">
									<p><?= !empty($db_txt) ? $db_txt : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus. Donec rutrum congue leo eget malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Quisque velit nisi, pretium ut lacinia in, elementum id enim.' ?></p>
									<div class="text-center">
										<img class="img-fluid" src="<?= !empty($db_img) ? 'assets/uploads/'.$db_img : 'assets/img/bg-abstract.png' ?>" />
									</div>
								</div>
							</div>
						</div>
					</div>-->
				</div>
			</div>

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
</body>
</html>