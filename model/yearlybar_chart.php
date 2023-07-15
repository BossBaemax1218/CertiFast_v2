
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
						<?php
							$paymentDataQuery = "SELECT YEAR(date) AS year_only, details, COUNT(*) AS total_payments FROM tblpayments GROUP BY YEAR(date), details";
							$stmt = $conn->prepare($paymentDataQuery);
							$stmt->execute();
							$paymentDataResult = $stmt->get_result();

							$labels = [];
							$datasets = [];

							if ($paymentDataResult->num_rows > 0) {
								$barangays = [];
								while ($row = $paymentDataResult->fetch_assoc()) {
									$year = $row['year_only'];
									$barangay = $row['details'];

									if (!in_array($barangay, $barangays)) {
										$barangays[] = $barangay;
									}

									if (!isset($datasets[$barangay])) {
										$datasets[$barangay] = [];
									}

									$datasets[$barangay][$year] = $row['total_payments'];

									if (!in_array($year, $labels)) {
										$labels[] = $year;
									}
								}

								sort($labels);
								?>
								<div class="page-inner">
									<div class="col">
										<div class="row">
											<div class="col-md-12">
												<div class="card">
													<div class="card-body">
														<canvas id="myChart" style="width: 100%; max-width: 1450px; height: 550px;"></canvas>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<script>
									var chartData = {
										labels: <?php echo json_encode($labels); ?>,
										datasets: [
											<?php foreach ($barangays as $barangay) { ?>
												{
													label: '<?php echo $barangay; ?>',
													data: [
														<?php foreach ($labels as $year) { ?>
															<?php echo isset($datasets[$barangay][$year]) ? $datasets[$barangay][$year] : 0; ?>,
														<?php } ?>
													],
													backgroundColor: getRandomColor(),
													borderColor: getRandomColor(),
													borderWidth: 1
												},
											<?php } ?>
										]
									};

									var chartOptions = {
										responsive: true,
										maintainAspectRatio: false,
										aspectRatio: 1.5,
										plugins: {
											legend: {
												position: "top"
											}
										},
										scales: {
											y: {
												beginAtZero: true
											}
										}
									};
									function getRandomColor() {
										var letters = "0123456789ABCDEF";
										var color = "#";
										for (var i = 0; i < 6; i++) {
											color += letters[Math.floor(Math.random() * 16)];
										}
										return color;
									}

									document.addEventListener("DOMContentLoaded", function () {
										var ctx = document.getElementById("myChart").getContext("2d");
										try {
											new Chart(ctx, {
												type: "bar",
												data: chartData,
												options: chartOptions
											});
										} catch (error) {
											console.error(error);
										}
									});
								</script>
								<?php
							} else {
								echo "No data found.";
							}
						?>