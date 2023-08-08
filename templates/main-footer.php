<footer class="footer">
    <div class="container-fluid">
        <div class="copyright ml-auto">
            <?php  $year = date("Y"); echo  $year . " &copy CertiFast Portal" ?>
        </div>				
    </div>
</footer>
<!-- Modal -->
<div class="modal fade" id="barangay" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Barangay Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/edit_brgy_info.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Province Name</label>
                                <input type="text" class="form-control" placeholder="Enter Province Name" name="province" required value="<?= $province ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Town Name</label>
                                <input type="text" class="form-control" placeholder="Enter Town Name" name="town" required value="<?= $town ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Barangay Name</label>
                                <input type="text" class="form-control" placeholder="Enter Barangay Name" name="brgy" required value="<?= $brgy ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" placeholder="Enter Contact Number" name="number" required value="<?= $number ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Barangay Email Address</label>
                        <input class="form-control" placeholder="Enter Barangay Email" name="b_email" required value="<?= $b_email ?>">
                    </div>
                    <div class="form-group">
                        <label>Barangay Address</label>
                        <input type="text" class="form-control" placeholder="Enter Barangay Address" name="brgy_address" required value="<?= $brgy_add ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Municipality/City Logo</label><br>
                                <img src="assets/uploads/<?= $city_logo ?>" class="img-fluid" width="120">
                                <input type="file" class='form-control' name="city_logo" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Barangay Logo</label><br>
                                <img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid" width="120">
                                <input type="file" class='form-control' name="brgy_logo" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Cover Photo</label><br>
                        <img src="<?= !empty($db_img) ? 'assets/uploads/'.$db_img : 'assets/img/LogoIcon.png' ?>" class="img-fluid">
                        <input type="file" class='form-control' name="db_img" accept="image/*">
                    </div>
                    <small class="form-text text-muted">Note: pls upload only image and not more than 20MB.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="restore" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Restore Database</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/restore.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="form-group form-floating-label">
                        <label>Upload Sql file</label>
                        <input type="file" class="form-control" accept=".sql" name="backup_file" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Restore</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit_user_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create System User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/edit_profile_user.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="text-center">
                        <div id="my_camera" style="height: 250;" class="text-center">
                            <?php if(empty($_SESSION['photo'])): ?>
                                <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" >
                            <?php else: ?>
                                <img src="<?= preg_match('/data:image/i', $_SESSION['photo']) ? $_SESSION['photo'] : 'assets/uploads/avatar/'.$_SESSION['photo'] ?>" alt="..." class="img img-fluid" width="250" >
                            <?php endif ?>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open Camera</button>
                            <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">Capture</button>   
                        </div>
                        <div id="profileImage">
                            <input type="hidden" name="profileimg">
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="img" accept="image/*">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= $_SESSION['fullname']; ?>" name="fullname">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>
