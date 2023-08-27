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

if (!empty($resident)) {
    $_SESSION['purok'] = $resident[0]['purok'];
}

$query1 = "SELECT * FROM tblpurok";
$result1 = $conn->query($query1); 

$purok = array();
while($row2 = $result1->fetch_assoc()){
    $purok[] = $row2; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>CertiFast Portal</title>
    <link rel="stylesheet" href="assets/css/trash-style.css">
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
        <div class="wrapper">
            <?php include 'templates/main-header.php' ?>
            <?php include 'templates/sidebar.php' ?>
            <div class="main-panel mt-5">
                <div class="container">
                    <div class="container panel-header mt-5">
                        <h1 class="text-center mb-4" style="font-size: 160%;">Items in your trash are only visible to you.</h1>
                    <div class="search-container ml-5">
                        <a class="btn btn-info btn-border btn-round btn-sm dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filter Options
                        </a>
                        <div class="dropdown-menu mt-3" aria-labelledby="filterDropdown">
                            <div class="dropdown-item">
                                <input type="text" id="searchInput" class="search-input form-control" placeholder="Search...">
                            </div>
                            <div class="dropdown-item">
                                <label>Date:</label>
                                <input type="date" class="form-control" id="fromDate" name="fromDate">
                            </div>
                            <div class="dropdown-item">
                                <button type="button" id="clearFilters" class="form-control btn btn-outline-primary">Clear Filters</button>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner">
                        <div class="row">
                            <div class="card-table">
                                <div class="col-md-12">
                                    <?php if (!empty($resident)): ?>
                                        <?php foreach ($resident as $row): ?>
                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    <?= $row['date_deleted'] ?>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <?= ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']) ?>
                                                    </h5>
                                                    <div class="card-text">
                                                        <p>Barangay ID: <?= $row['national_id'] ?></p>
                                                        <p>Birthdate: <?= $row['birthdate'] ?></p>
                                                        <p>Age: <?= $row['age'] ?></p>
                                                        <p>Address: <?= $row['address'] ?></p>
                                                        <p>Purok: <?= $row['purok'] ?></p>
                                                    </div>
                                                    <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator'): ?>
                                                        <div class="form-button-action">
                                                            <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
                                                                <a type="button" class="btn btn-link btn-primary" data-toggle="modal" data-target="#restoreModal<?= $row['id'] ?>" data-original-title="Restore">
                                                                    <i class="fa-solid fa-arrow-rotate-left"></i> Restore
                                                                </a>
                                                                <a type="button" class="btn btn-link btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?= $row['id'] ?>" data-original-title="Remove">
                                                                    <i class="fas fa-trash"></i> Delete
                                                                </a>
                                                            <?php endif ?>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    <?php endif ?>
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

    </div>
<?php include 'templates/main-footer.php' ?>
<?php include 'templates/footer.php' ?>
<script>
const filterDateInput = document.getElementById('fromDate');
const searchInput = document.getElementById('searchInput');
const cards = document.querySelectorAll('.card');
const clearFiltersBtn = document.getElementById('clearFilters');

function applyFilter() {
    const selectedDate = filterDateInput.value;

    cards.forEach(card => {
        const cardDate = card.querySelector('.card-header').textContent;
        const dateMatch = selectedDate === '' || cardDate === selectedDate;

        card.style.display = dateMatch ? 'block' : 'none';
    });
}

function clearFilters() {
    searchInput.value = '';
    filterDateInput.value = '';
    applyFilter();
}
filterDateInput.addEventListener('change', applyFilter);
filterDateInput.addEventListener('change', applyFilter);
clearFiltersBtn.addEventListener('click', clearFilters);

searchInput.addEventListener('input', () => {
    const searchText = searchInput.value.toLowerCase();

    cards.forEach(card => {
        const cardText = card.textContent.toLowerCase();
        card.style.display = cardText.includes(searchText) ? 'block' : 'none';
    });
});
</script>
</body>
</html>