                <div class="col-md-12">
									<div class="card">
										<div class="card-header">
											<div class="card-head-row">
												<div class="card-title fw-bold">
													<h3><strong>Requested Certificates</strong></h3>
												</div>
												<div class="filter" style="margin-left: 80%">
													<div class="dropdown">
														<button class="btn dropdown-toggle" type="button" id="dateRangeDropdown" data-toggle="dropdown" aria-expanded="false">
															Filter
														</button>
														<ul class="dropdown-menu" aria-labelledby="dateRangeDropdown">
															<li><a class="dropdown-item" href="#" onclick="applyDateRangeFilter('all')">All</a></li>
															<li><a class="dropdown-item" href="#" onclick="applyDateRangeFilter('day')">Day</a></li>
															<li><a class="dropdown-item" href="#" onclick="applyDateRangeFilter('week')">Week</a></li>
															<li><a class="dropdown-item" href="#" onclick="applyDateRangeFilter('month')">Month</a></li>
															<li><a class="dropdown-item" href="#" onclick="applyDateRangeFilter('year')">Year</a></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<div class="card-body">
											<canvas id="myChart3" style="width:100%; max-width:100%"></canvas>
											<script>
											var ctx = document.getElementById("myChart3");
											var myChart3 = new Chart(ctx, {
												type: 'bar', // Change chart type to bar
												data: {
													labels: [
														<?php foreach($dateRangeLabels as $label): ?>
															"<?= $label ?>",
														<?php endforeach; ?>
													],
													datasets: [{
														label: 'Certificate Counts',
														data: [
															<?php foreach($dateRangeData as $data): ?>
																<?= $data ?>,
															<?php endforeach; ?>
														],
														backgroundColor: '#36A2EB', // Set bar color
														borderColor: '#36A2EB',
														borderWidth: 1
													}]
												},
												options: {
													scales: {
														y: {
															beginAtZero: true
														}
													}
												}
											});
										</script>
										</div>
									</div>
								</div>