<?php include 'server/server.php' ?>
<?php 
	$query1 = "SELECT * FROM tbl_user_admin WHERE user_type='staff'";
    $result1 = $conn->query($query1);
	$staff = $result1->num_rows;

	$query5 = "SELECT * FROM tblpurok";
	$purok = $conn->query($query5)->num_rows;

	$query8 = "SELECT SUM(amounts) as am FROM tblpayments";
	$revenue = $conn->query($query8)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Overview - Dashboard</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<style>
        .chart-container {
            display: flex;
            overflow-x: scroll;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
        }

        .chart {
            flex: 0 0 100%;
            scroll-snap-align: start;
            width: 100%;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
            position: sticky;
            top: 0;
            background-color: transparent;
            z-index: 1;
        }

        .button {
            padding: 10px 20px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #45a049;
        }

        /* Custom scrollbar styles */
        .chart-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .chart-container::-webkit-scrollbar-track {
            background-color: transparent;
        }

        .chart-container::-webkit-scrollbar-thumb {
            background-color: transparent;
        }

        .chart-container::-webkit-scrollbar-thumb:hover {
            background-color: transparent;
        }

        .chart-container::-webkit-scrollbar-button {
            background-color: #aaa;
        }

        .chart-container::-webkit-scrollbar-button:hover {
            background-color: #888;
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
						<div class="panel-header">
							<div class="page-inner">
								<?php if(isset($_SESSION['message'])): ?>
										<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
											<?php echo $_SESSION['message']; ?>
										</div>
									<?php unset($_SESSION['message']); ?>
								<?php endif ?>
								<div class="d-flex align-items-left align-items-md-left flex-column flex-md-column">
									<div class="d-flex align-items-center align-items-md-center flex-row flex-md-row">
										<h3 class="fw-bold" style="font-size: 300%;">Overview</h3>
									</div>									
								</div>
								<div class="card-header" style="text-align: left; border: none; padding: none; background: none;">
									<div class="md-0">
										<button class="btn btn-danger" type="button" id="pdf" style="padding: 10px 20px; background-color: #fff; border-radius: 2px; border-bottom: 3px solid #111;">
											<i class="fas fa-download"></i>  Export PDF
										</button>
										<!--<button class="btn btn-primary" type="button" placeholder="Pick date rage" id="kt_daterangepicker_3" data-toggle="modal" style="padding: 10px 20px; background-color: #fff; border-radius: 2px; border-bottom: 3px solid;">
											<i class="far fa-calendar-alt"></i>  DATE
										</button>-->										
									</div>
								</div>
							</div>
						</div>
						<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
						<?php endif ?>
						<div class="button-container">
							<button class="button" onclick="scrollToPrevChart()">Previous</button>
							<button class="button" onclick="scrollToNextChart()">Next</button>
						</div>
						<div class="chart-container" id="chartContainer">
							<div class="chart">
								<?php include 'model/weeklybar_chart.php' ?>
							</div>
							<div class="chart">
								<?php include 'model/monthlybar_chart.php' ?>
							</div>
							<div class="chart">
								<?php include 'model/yearlybar_chart.php' ?>
							</div>
							<div class="chart">
								<?php include 'model/dailybar_chart.php' ?>
							</div>
							<div class="chart">
								<?php include 'model/mostcertbar_chart.php' ?>
							</div>
						</div>
					</div>
				<?php include 'templates/main-footer.php' ?>
			</div>
		</div>
	<?php include 'templates/footer.php' ?>
	<script>
        function scrollToNextChart() {
            const container = document.getElementById('chartContainer');
            container.scrollBy({ left: container.offsetWidth, behavior: 'smooth' });
        }

        function scrollToPrevChart() {
            const container = document.getElementById('chartContainer');
            container.scrollBy({ left: -container.offsetWidth, behavior: 'smooth' });
        }
    </script>
	<script>
		  $(document).on("click", "#pdf", function() {
		console.log("Exporting revenue table as PDF...");
		$("#revenuetable").tableHTMLExport({ type: "pdf", filename: "Revenue.pdf" });
	});
	</script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script>
		$("#kt_daterangepicker_3").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
				maxYear: parseInt(moment().format("YYYY"),12)
			}, function(start, end, label) {
				var years = moment().diff(start, "years");
				alert("You are " + years + " years old!");
			}
		);
	</script>
</body>
</html>