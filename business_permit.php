<?php include 'server/server.php' ?>
<?php 
	$sql = "SELECT *,id, cert_name FROM `tblpermit` WHERE status IN ('on hold', 'operating','suspended','closed')";
    $result = $conn->query($sql);
    
    $resident = array();
    while ($row = $result->fetch_assoc()) {
        $status = $row['status'];
        $statusBadge = '';
    
        if ($status === 'on hold') {
            $statusBadge = '<span class="badge badge-warning">On Hold</span>';
        } elseif ($status === 'operating') {
            $statusBadge = '<span class="badge badge-success">Operating</span>';
        } elseif ($status === 'suspended') {
            $statusBadge = '<span class="badge badge-warning">Suspended</span>';
        } elseif ($status === 'closed') {
            $statusBadge = '<span class="badge badge-danger">Closed</span>';
        }
    
        $row['residency_badge'] = $statusBadge;
    
        if ($status == 'on hold' || $status == 'operating' || $status == 'suspended') {
            $row['id'] = $row['id'];
    
            $resident[] = $row;
        }
    }

	$query1 = "SELECT COUNT(cert_name) as pending FROM tblpermit WHERE status = 'on hold'"; 
    $revenue1 = $conn->query($query1)->fetch_assoc();

    $sql1 = "SELECT COUNT(cert_name) as approved FROM tblpermit WHERE status = 'operating'";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    $residencyCount = $row1['approved'];

	$query2 = "SELECT COUNT(cert_name) as rejected FROM tblpermit WHERE status = 'suspended'";
	$revenue3 = $conn->query($query2)->fetch_assoc();

    $query3 = "SELECT COUNT(cert_name) as claimed FROM tblpermit WHERE status = 'closed'";
	$revenue4 = $conn->query($query3)->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>CertiFast Portal</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="row mt-2">
						<div class="panel-header">
							<div class="page-inner">
								<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
									<div class="text-center">
										<h1 class="text-center fw-bold" style ="font-size: 300%;">List of Requested Business Permit</h1>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex align-items-center align-items-md-center flex-column flex-md-row">
                            <div class="col-md-3">
                                <div class="card card-stats card card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fa fa-history fa-2x" aria-hidden="true" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Pending</h2>
                                                    <h3 class="fw-bold" style="font-size: 25px; color: #C77C8D;"><?= number_format($revenue1['pending']) ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="revenue.php?state=all" class="card-link text" style="color: gray;"></a>
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
                                                    <i class="fa fa-check fa-2x" aria-hidden="true" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Operating</h2>
                                                    <h3 class="fw-bold" style="font-size: 25px; color: #C77C8D;"><?= number_format($residencyCount)?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="revenue.php?state=revenue" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fa fa-ban fa-2x" aria-hidden="true" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h3 class="text-uppercase" style="font-size: 16px;">Suspended</h3>
                                                    <h5 class="fw-bold text-uppercase" style="font-size: 25px; color: #C77C8D;"><?= number_format($revenue3['rejected'])?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="purok_info.php?state=purok" class="card-link text" style="color: gray;"></a>
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
                                                    <i class="fa fa-close fa-2x" aria-hidden="true" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Closed</h2>
                                                    <h3 class="fw-bold" style="font-size: 25px; color: #C77C8D;"><?= number_format($revenue4['claimed']) ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="revenue.php?state=all" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
					    </div>
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
										<div class="card-title">                                                                                
                                        </div>
										<?php if(isset($_SESSION['username'])):?>
                                                <div class="card-tools">
                                                    <a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
                                                        <i class="fa fa-plus"></i>
                                                        Business Permit
                                                    </a>
                                                    <a class="btn btn-info btn-border btn-round btn-sm dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Filter Options
                                                    </a>
                                                    <div class="dropdown-menu mt-3 mr-3" aria-labelledby="filterDropdown">
                                                        <div class="dropdown-item">
                                                            <label>Status:</label>
                                                            <select class="form-control" id="filterStatus" name="status" onclick="event.stopPropagation();">
                                                                <option value="">All</option>
                                                                <option value="on hold">On Hold</option>
                                                                <option value="operating">Operating</option>
                                                                <option value="suspended">Suspended</option>
                                                                <option value="closed">Closed</option>
                                                            </select>
                                                        </div>
                                                        <div class="dropdown-item">
                                                            <label>From Date:</label>
                                                            <input type="date" class="form-control" id="fromDate" placeholder="Select date range">
                                                        </div>
                                                        <div class="dropdown-item">
                                                            <label>To Date:</label>
                                                            <input type="date" class="form-control" id="toDate" placeholder="Select date range">
                                                        </div>
                                                        <div class="dropdown-item">
                                                            <button type="button" class="form-control btn btn-outline-primary" id="clearFilters">Clear Filter</button>
                                                        </div>
                                                    </div>
                                                    <a id="pdf" class="btn btn-light btn-border btn-sm">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </div>
                                            <?php endif?>
                                        </div>
                                    </div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="table">
											<thead>
												<tr class="text-center">
												    <th scope="col">Permit #</th>
													<th scope="col">Date</th>
													<th scope="col">Nature of Business</th>
													<th scope="col">Owner Name</th>
													<th scope="col">Address</th>
													<th scope="col">Valid Until</th>
													<th scope="col">Status</th>
													<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($resident)): ?>
													<?php foreach($resident as $row): ?>
    													<tr data-id=<?= $row['id'] ?> class="text-center">
    													<td><?= ucwords($row['permit_number']) ?></td>
														<td><?= ucwords($row['applied']) ?></td>
														<td><?= ucwords($row['business_name']) ?></td>
														<td><?= !empty($row['owner1']) ? ucwords($row['owner1']) : $row['owner1'] ?></td>
														<td><?= $row['address'] ?></td>
														<td><?= $row['validation'] ?></td>
														<td class="text-center"><?= $row['residency_badge'] ?></td>	
                                                        <?php if(isset($_SESSION['username'])):?>
														<td>
															<div class="form-button-action">
																<a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary"
																	title="Edit Permit" onclick="editPermit(this)" data-id="<?= $row['id'] ?>" data-permit_number="<?= $row['permit_number'] ?>" data-business_name="<?= $row['business_name'] ?>" data-owner1="<?= $row['owner1'] ?>"
																	data-email="<?= $row['email'] ?>" data-address="<?= $row['address'] ?>" data-location="<?= $row['location'] ?>" data-applied="<?= $row['applied'] ?>"
																	data-community_tax="<?= $row['community_tax'] ?>" data-issued_on="<?= $row['issued_on'] ?>" data-issued_at="<?= $row['issued_at'] ?>"  data-validation="<?= $row['validation'] ?>"
																	data-status="<?= $row['status'] ?>">
																	<i class="fas fa-edit"></i>
																</a>
                                                                <?php
                                                                    $status = $row['status'];
                                                                    $btnDisabled = ($status === 'on hold') ? 'disabled' : '';
                                                                ?>
                                                                <a type="button" data-toggle="tooltip" class="btn btn-link btn-danger generate-certificate-btn" data-original-title="Generate Certificate" data-certificate_name="<?= $row['cert_name'] ?>" data-status="<?= $status ?>" <?= $btnDisabled ?>>
                                                                    <i class="fas fa-print"></i>
                                                                </a>
																<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'): ?>
                                                                    <a type="button" class="btn btn-link btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?= $row['id'] ?>" data-original-title="Remove">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </a>
																<?php endif ?>
															</div>
														</td>
														<?php endif ?>														
													</tr>
													<?php endforeach ?>
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
            <?php foreach ($resident as $row) { ?>
        <div class="modal fade" id="confirmDeleteModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="mt-3 modal-body text-center" style="font-size: 16px;">
                        Are you sure you want to remove this request?
                    </div>
                    <div class="modal-footer mt-2 d-flex justify-content-center">
                        <form method="post" action="model/trash_permit_records.php">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="button" class="btn btn-danger text-center mr-2">No</button>
                            <button type="submit" class="btn btn-primary text-center">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
			<!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Business Permit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
						<form method="POST" action="model/save_permit.php" >
								<div class="form-group">
                                    <label>Permit #</label>
                                    <input type="text" class="form-control" placeholder="000-000" name="permit_number" required>
                                </div>
                                <div class="form-group">
                                    <label>Nature of Business</label>
                                    <input type="text" class="form-control" placeholder="(Sari-Sari Store)" name="business_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Proprietor</label>
                                    <input type="text" class="form-control mb-2" placeholder="Enter your name" name="owner1" required>
                                </div>
								<div class="form-group">
                                    <label>Business Email</label>
                                    <input type="text" class="form-control mb-2" placeholder="Enter your email address" name="email" required>
                                </div>
								<div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control mb-2" placeholder="Enter your current address" name="address" required>
                                </div>
								<div class="form-group">
                                    <label>Business Location</label>
                                    <input type="text" class="form-control mb-2" placeholder="Enter your business located" name="location" required>
                                </div>
								<div class="form-group">
                                    <label>CTC #</label>
                                    <input type="text" class="form-control" placeholder="0000-00000" name="community_tax" required>
                                </div>
								<div class="form-group">
                                    <label>Issued On</label>
                                    <input type="date" class="form-control" name="issued_on" value="<?= date('Y-m-d'); ?>" required>
                                </div>
								<div class="form-group">
                                    <label>Issued At</label>
                                    <input type="text" class="form-control" value="Barangay Los Amigos, Davao City" name="issued_at" required>
                                </div>
								<div class="form-group">
                                    <label>Valid Until</label>
                                    <input type="date" class="form-control" name="validation" value="<?= date('Y-m-d', strtotime('+9 months')); ?>" required>
                                </div>
								<div class="form-group">
                                    <label>Date Applied</label>
                                    <input type="date" class="form-control" name="applied" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Reasons for applying</label>
                                    <input type="text" class="form-control" name="requirement" id="requirement" placeholder="Reason" required>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
									<select class="form-control btn btn-light btn-primary" name="status" id="status">
										<option value="on hold">On Hold</option>
										<option value="operating">Operating</option>
										<option value="suspended">Suspended</option>
										<option value="closed">Closed</option>
									</select>
                                </div>
                       		</div>
							<div class="modal-footer mt-2 d-flex justify-content-center">
                                <input type="hidden" name="certificate_name" value="business permit">
								<button type="submit" class="btn btn-danger">Submit</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>

			<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Business Permit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_permit.php" >
								<input type="hidden" class="form-control" name="applied"  id="applied" value="<?= date('Y-m-d'); ?>" readonly>
								<input type="hidden" class="form-control" placeholder="" name="business_name" id="business_name" readonly>
								<input type="hidden" class="form-control mb-2" placeholder="" name="owner1" id="owner1" readonly>
                                <input type="hidden" class="form-control mb-2" placeholder="" name="email" id="email" readonly>
                                <input type="hidden" class="form-control mb-2" placeholder="" name="address" id="address" readonly>
                                <input type="hidden" class="form-control mb-2" placeholder="" name="location" id="location" readonly>
								<div class="form-group">
                                    <label>Permit #</label>
                                    <input type="text" class="form-control" placeholder="" name="permit_number" id="permit_number" required>
                                </div>
								<div class="form-group">
                                    <label>CTC #</label>
                                    <input type="text" class="form-control" name="community_tax" id="community_tax"  value="" required>
                                </div>
								<div class="form-group">
                                    <label>Issued On</label>
                                    <input type="date" class="form-control" name="issued_on" id="issued_on" value="<?= date('Y-m-d'); ?>" required>
                                </div>
								<div class="form-group">
                                    <label>Issued At</label>
                                    <input type="text" class="form-control" name="issued_at" id="issued_at" value="Barangay Los Amigos, Davao City" required>
                                </div>
								<div class="form-group">
                                    <label>Valid Until</label>
                                    <input type="date" class="form-control" name="validation" id="validation" required>
                                </div>
								<div class="form-group">
                                    <label>Status</label>
									<select class="form-control btn btn-light btn-primary" name="status" id="status">
										<option value="on hold">On Hold</option>
										<option value="operating">Operating</option>
										<option value="suspended">Suspended</option>
										<option value="closed">Closed</option>
									</select>
                                </div>
                       		</div>
							<div class="modal-footer mt-2 d-flex justify-content-center">
                                <input type="hidden" name="certificate_name" value="business permit" required>
								<input type="hidden" name="id" id="id">										
								<button type="submit" class="btn btn-danger">Change</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
<script>
   document.addEventListener("DOMContentLoaded", function () {
    var rows = document.querySelectorAll("#residenttable tbody tr");
    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];
        var id = row.getAttribute("data-id");
        var generateBtn = row.querySelector(".generate-certificate-btn");

        (function (id) {
            generateBtn.addEventListener("click", function () {
                var certificateName = this.getAttribute("data-certificate_name");
                var status = this.getAttribute("data-status");
                if (status === "operating") {
                    switch (certificateName.toLowerCase()) {
                        case 'business permit':
                            window.location.href = 'generate_business_permit.php?id=' + id;
                            break;
                        default:
                            window.location.href = 'business_permit.php';
                            break;
                    }
                }
            });
        })(id);
    }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const filterStatus = document.getElementById("filterStatus");
  const fromDate = document.getElementById("fromDate");
  const toDate = document.getElementById("toDate");
  const clearFiltersBtn = document.getElementById("clearFilters");
  
  const tableRows = document.querySelectorAll("#residenttable tbody tr");
  
  function rowMatchesFilter(row) {
    const statusValue = filterStatus.value.toLowerCase();
    const rowStatus = row.querySelector("td:nth-child(7)").textContent.toLowerCase();
    const rowDate = new Date(row.querySelector("td:nth-child(2)").textContent);
    const from = new Date(fromDate.value);
    const to = new Date(toDate.value);

    return (statusValue === "" || rowStatus.includes(statusValue)) &&
            (isNaN(from) || rowDate >= from) &&
           (isNaN(to) || rowDate <= to);
  }
  
  function applyFilter() {
    tableRows.forEach(row => {
      const shouldDisplay = rowMatchesFilter(row);
      row.style.display = shouldDisplay ? "table-row" : "none";
    });
  }

  function clearFilters() {
    filterStatus.value = "";
    fromDate.value = "";
    toDate.value = "";
    applyFilter();
  }

  filterStatus.addEventListener("change", applyFilter);
  fromDate.addEventListener("change", applyFilter);
  toDate.addEventListener("change", applyFilter);
  clearFiltersBtn.addEventListener("click", clearFilters);
});
</script>
	<script>
    function editPermit(that) {
        $('#id').val($(that).data('id'));
		$('#permit_number').val($(that).data('permit_number'));
        $('#business_name').val($(that).data('business_name'));
        $('#owner1').val($(that).data('owner1'));
        $('#email').val($(that).data('email'));
        $('#address').val($(that).data('address'));
        $('#location').val($(that).data('location'));
        $('#applied').val($(that).data('applied'));
        $('#community_tax').val($(that).data('community_tax'));
        $('#issued_on').val($(that).data('issued_on'));
        $('#issued_at').val($(that).data('issued_at'));
        $('#validation').val($(that).data('validation'));
        $('#status').val($(that).data('status')); 
        $('#editModal').modal('show');
    }
</script>
    <script>
        $(document).ready(function() {
            $('#residenttable').DataTable();
        });
    </script>
        <script>
        $(document).on("click", "#pdf", function () {
        console.log("Exporting business permit table as PDF...");

        const currentDate = new Date().toISOString().slice(0, 10);

        const title = "Business Permit Files - " + currentDate;
        const filename = "Business Permit_" + currentDate + ".pdf";

        const doc = new jsPDF();

        doc.setFontSize(20);
        doc.text(title, 15, 15);

        const options = { startY: 25 };
        doc.autoTable({ html: "#residenttable", startY: 30 });

        doc.save(filename);
        });
    </script>
</body>
</html>