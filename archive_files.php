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
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel mt-2">
			<div class="content">
				<div class="panel-header">
                    <h1 class="text-center mt-4" style="font-size: 160%;">Items in your trash are only visible to you.</h1>
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
                                                    <a id="pdf" class="btn btn-light btn-border btn-sm">
                                                        <i class="fas fa-download"></i>
                                                            Export PDF
                                                    </a>
                                                </div>
                                            <?php endif?>
                                        </div>                                    
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="residenttable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col" class="text-center">ID no.</th>
                                                        <th scope="col">Fullname</th>
                                                        <th scope="col">Address</th>
                                                        <th scope="col">Birthdate</th>
                                                        <th scope="col">Age</th>
                                                        <th scope="col">Gender</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Purok</th>
                                                        <?php if(isset($_SESSION['username'])):?>
                                                            <?php if($_SESSION['role']=='purok leader'):?>
                                                        <?php endif ?>
                                                        <th class="text-center" scope="col">Action</th>
                                                        <?php endif ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (!empty($resident)): ?>
                                                    <?php $no = 1; foreach ($resident as $row): ?>
                                                    <tr>
                                                        <td><?= $row['date_deleted'] ?></td>
                                                        <td><?= $row['national_id'] ?></td>
                                                        <td>
                                                            <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
                                                        </td>
                                                        <td><?= $row['address'] ?></td>
                                                        <td><?= $row['birthdate'] ?></td>
                                                        <td><?= $row['age'] ?></td>
                                                        <td><?= $row['gender'] ?></td>
                                                        <td><?= $row['email'] ?></td>
                                                        <td><?= $row['purok'] ?></td>
                                                        <?php if(isset($_SESSION['username'])):?>
                                                        
                                                        <?php if($_SESSION['role']=='purok leader'):?>                                                           
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
</body>
</html>