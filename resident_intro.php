<?php include 'server/db_connection.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'templates/header.php' ?>                 
	<title>Certifast Portal</title>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
        <?php include 'templates/main-header-resident.php' ?>
		<?php include 'templates/sidebar-resident.php' ?>
		    <div class="main-panel">
			    <div class="content">
                    <div>
                        <h1 class="text-center fw-bold mt-5" style="font-size: 300%;"></h1>
                    </div>
                    <div class="page-inner mt-2">
                        <div class="row">
                            <div class="modal fade" id="support" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Contact Support</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="background-color: white">
                                            <form method="POST" action="model/save_support.php">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Enter Name" name="name" required >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="email" class="form-control" placeholder="Enter Email Address" name="email" required >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Enter Contact Number(optional)" name="number">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Enter Subject" name="subject" required>
                                                </div>
                                                <div class="form-group">
                                                    <textarea type="text" class="form-control" placeholder="Enter Message" name="message" required ></textarea>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                        </form>
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
</body>
</html>