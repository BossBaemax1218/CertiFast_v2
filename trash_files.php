<?php
include 'server/server.php';

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM tbl_trash";
$result = $conn->query($sql);

$resident = array();
while ($row = $result->fetch_assoc()) {
    $resident[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>CertiFast Portal</title>
    <style>
        .table-responsive {
            overflow-x: auto;
        }
        .trash-table {
            width: 100%;
            border-collapse: collapse;
        }
        .trash-table th,
        .trash-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .trash-table th {
            background-color: #f0f0f0;
        }
        .card {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
            padding: 8px 16px;
            border-radius: 5px;
        }
        .btn-light {
            background-color: #f0f0f0;
        }
        .trash-icon {
            font-size: 24px;
            margin-right: 10px;
        }
        .btn-danger {
            background-color: #d9534f;
            color: white;
        }
        .btn-primary {
            background-color: #5bc0de;
            color: white;
        }
        
        /* Custom trash-themed styles */
        .trash-header {
            background-color: #424242;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .trash-header h1 {
            font-size: 24px;
        }
        .trash-table {
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .trash-table th {
            background-color: #E42654;
            color: white;
            font-weight: bold;
        }
        .trash-table td {
            vertical-align: middle;
        }
        .trash-table td:nth-child(6) {
            text-align: center;
        }
        .trash-icon {
            color: #d9534f;
            cursor: pointer;
        }
        .restore-icon {
            color: #5bc0de;
            cursor: pointer;
        }
        .trash-icon:hover,
        .restore-icon:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel mt-2">
			<div class="content">
				<div class="panel-header">
                    <div class="trash-header">
                        <h1>Items in your trash are only visible to you.</h1>
                    </div>
                    <div class="page-inner">
                        <div class="row">
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
                                    <div class="card-header md-2">
                                        <div class="card-head-row">
                                            <div class="card-title fw-bold"></div>
                                            <?php if(isset($_SESSION['username'])):?>
                                                <div class="card-tools">
                                                    <!--<a data-toggle="modal" href="#confirmDeleteModal" class="btn btn-danger btn-border btn-sm ml-2">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                        Delete
                                                    </a>
                                                    <a data-toggle="modal" href="#restoreModal" class="btn btn-primary btn-border btn-sm ml-2">
                                                        <i class="fa-solid fa-arrow-rotate-left"></i>
                                                        Restore
                                                    </a>-->
                                                    <a class="btn btn-light btn-border btn-sm dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Filter Options
                                                    </a>
                                                    <a id="pdf" class="btn btn-light btn-border btn-sm">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <div class="dropdown-menu mt-3" aria-labelledby="filterDropdown">
                                                        <div class="dropdown-item">
                                                            <label>From Date:</label>
                                                            <input type="date" class="form-control datepicker" id="fromDate" placeholder="Select date range">
                                                        </div>
                                                        <div class="dropdown-item">
                                                            <label>To Date:</label>
                                                            <input type="date" class="form-control datepicker" id="toDate" placeholder="Select date range">
                                                        </div>
                                                        <div class="dropdown-item">
                                                            <button type="button" id="clearFilters" class="form-control btn btn-outline-primary">Clear Filters</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif?>
                                        </div>                                    
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="residenttable" class="trash-table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Barangay ID</th>
                                                        <th class="text-center" scope="col">Fullname</th>												
                                                        <th scope="col">Birthdate</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Purok</th>
                                                        <th class="text-center" scope="col"> Date</th>
                                                        <?php if(isset($_SESSION['username'])):?>
                                                            <?php if($_SESSION['role']=='administrator'):?>
                                                        
                                                        <?php endif ?>
                                                        <th class="text-center" scope="col">Action</th>
                                                        <?php endif ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(!empty($resident)): ?>
                                                        <?php $no=1; foreach($resident as $row): ?>
                                                        <tr>
                                                            <td><?= $row['national_id'] ?></td>
                                                            <td>
                                                                <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
                                                            </td>														
                                                            <td><?= $row['birthdate'] ?></td>
                                                            <td><?= $row['email'] ?></td>
                                                            <td><?= $row['purok'] ?></td>
                                                            <td class="text-center" ><?= $row['date_deleted'] ?></td>
                                                            <?php if(isset($_SESSION['username'])):?>
                                                                
                                                                <?php if($_SESSION['role']=='administrator'):?>
                                                            
                                                            <?php endif ?>
                                                            <td class="text-center">
                                                                <div class="form-button-action">
                                                                    <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
                                                                        <a type="button" class="btn btn-link btn-primary" data-toggle="modal" data-target="#restoreModal<?= $row['id'] ?>" data-original-title="Restore">
                                                                            <i class="fa-solid fa-arrow-rotate-left"></i>
                                                                        </a>
                                                                        <a type="button" class="btn btn-link btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?= $row['id'] ?>" data-original-title="Remove">
                                                                            <i class="fas fa-trash"></i>
                                                                        </a>
                                                                    <?php endif ?>
                                                                </div>
                                                            </td>
                                                            <?php endif ?>														
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
            </div>
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
                    <div class="modal-body text-center" style="font-size: 16px">
                        Are you sure you want to permanently delete this file?
                    </div>
                    <div class="modal-footer mt-2 d-flex justify-content-center">
                        <form method="post" action="model/delete_trash.php">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="button" class="btn btn-danger text-center mr-2" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary text-center">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php foreach ($resident as $row) { ?>
        <div class="modal fade" id="restoreModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center" style="font-size: 16px">
                        Are you sure you want to restore this file?
                    </div>
                    <div class="modal-footer mt-2 d-flex justify-content-center">
                        <form method="post" action="model/restore_archive.php">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="button" class="btn btn-danger text-center mr-2" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary text-center">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
        <?php include 'templates/main-footer.php' ?>
    </div>
<?php include 'templates/footer.php' ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const fromDate = document.getElementById("fromDate");
  const toDate = document.getElementById("toDate");
  const clearFiltersBtn = document.getElementById("clearFilters");
  
  const tableRows = document.querySelectorAll("#residenttable tbody tr");
  
  function rowMatchesFilter(row) {
    const rowDate = new Date(row.querySelector("td:nth-child(6)").textContent);
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
    <script>
        $(document).on("click", "#pdf", function () {
        console.log("Exporting resident table as PDF...");

        const currentDate = new Date().toISOString().slice(0, 10);

        const title = "Resident Trash Files - " + currentDate;
        const filename = "Resident_" + currentDate + ".pdf";

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