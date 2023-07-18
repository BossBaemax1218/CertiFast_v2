<?php include 'server/server.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Overview - Dashboard</title>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>
			<div class="wrapper">
				<?php include 'templates/main-header.php' ?>
				<?php include 'templates/sidebar.php' ?>
				<div class="main-panel">
					<div class="content">
						<div class="panel-header">
								<?php if(isset($_SESSION['message'])): ?>
										<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
											<?php echo $_SESSION['message']; ?>
										</div>
									<?php unset($_SESSION['message']); ?>
								<?php endif ?>
								<div class="d-flex flex-column">
									<div class="d-flex">
										<h3 class="fw-bold ml-1" style="font-size: 300%;">Overview</h3>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="chart-wrapper">
												<?php include 'model/weeklybar_chart.php' ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="chart-wrapper">
												<?php include 'model/monthlybar_chart.php' ?>
											</div>
										</div>
									</div>
									<div class="row ">
										<div class="col-md-6">
											<div class="chart-wrapper">
												<?php include 'model/yearlybar_chart.php' ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="chart-wrapper">
												<?php include 'model/mostcertbar_chart.php' ?>
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
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>