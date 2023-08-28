<?php include 'server/server.php' ?>
<?php
    $query = "SELECT * FROM tbl_announcement ORDER BY id ASC";
    $result = $conn->query($query);

    $announce = array();
	while($row = $result->fetch_assoc()){
		$announce[] = $row; 
	}
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
				<div class="panel-header">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-black fw-bold" style="font-size: 300%">Position Management</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt-2">
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
										<div class="card-title"></div>
										<div class="card-tools">
                                            <a class="btn btn-info btn-border btn-round btn-sm dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Filter Options
                                            </a>
                                            <div class="dropdown-menu mt-3 mr-3" aria-labelledby="filterDropdown">
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
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table id="residenttable" class="table">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($announce)): ?>
                                                    <?php $no=1; foreach($announce as $row): ?>
                                                    <tr class="text-center">
                                                        <td><?= $row['date_posted'] ?></td>
                                                        <td><?= $row['subject'] ?></td>
                                                        <td><?= $row['username'] ?></td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                <a type="button" href="#view" data-toggle="modal" class="btn btn-link btn-primary" 
                                                                    title="Edit Announcement" onclick="editAnnoucement(this)" data-subject="<?= $row['subject'] ?>" data-message="<?= $row['message'] ?>" 
                                                                    data-username="<?= $row['username'] ?>" data-date_posted="<?= $row['date_posted'] ?>" data-id="<?= $row['id'] ?>">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_announcement.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this position?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center">No Available Data</td>
                                                    </tr>
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
            <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View Announcement</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_position.php" >
                            <div class="form-group">
                                <label for="position">Date</label>
                                <input type="date" class="form-control" id="date_posted" name="date_posted" required>
                            </div>
                            <div class="form-group">
                                <label for="position">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>  
                            <div class="form-group">
                                <label for="position">Subject</label>
                                <textarea type="text" class="form-control" id="subject" name="subject" required></textarea>
                            </div>  
                            <div class="form-group">
                                <label for="position">Message</label>
                                <textarea type="text" class="form-control" rows="10" id="message" name="message" required></textarea>
                            </div>                        
                        </div>
                        <div class="modal-footer mt-2 d-flex justify-content-center">
                            <input type="hidden" id="pos_id" name="id">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
			<?php include 'templates/main-footer.php' ?>
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
    <script>
    function editAnnoucement(that) {
        $('#id').val($(that).data('id'));
		$('#subject').val($(that).data('subject'));
        $('#message').val($(that).data('message'));
        $('#username').val($(that).data('username'));
        $('#date_posted').val($(that).data('date_posted'));
    }
</script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
  const fromDate = document.getElementById("fromDate");
  const toDate = document.getElementById("toDate");
  const clearFiltersBtn = document.getElementById("clearFilters");
  
  const tableRows = document.querySelectorAll("#residenttable tbody tr");
  
  function rowMatchesFilter(row) {
    const rowDate = new Date(row.querySelector("td:nth-child(1)").textContent);
    const from = new Date(fromDate.value);
    const to = new Date(toDate.value);

    return (isNaN(from) || rowDate >= from) &&
           (isNaN(to) || rowDate <= to);
  }
  
  function applyFilter() {
    tableRows.forEach(row => {
      const shouldDisplay = rowMatchesFilter(row);
      row.style.display = shouldDisplay ? "table-row" : "none";
    });
  }

  function clearFilters() {
    fromDate.value = "";
    toDate.value = "";
    applyFilter();
  }

  fromDate.addEventListener("change", applyFilter);
  toDate.addEventListener("change", applyFilter);
  clearFiltersBtn.addEventListener("click", clearFilters);
});
</script>
</body>
</html>