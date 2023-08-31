<div class="row">
                                                <div class="col-sm-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="min">Minimum Date</label>
                                                        <input type="text" class="form-control datepicker" placeholder="Enter Date" id="min">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="max">Maximum Date</label>
                                                        <input type="text" class="form-control datepicker" placeholder="Enter Date" id="max">
                                                    </div>
                                                </div>
                                            </div>



                                            <?php 
include('../server/server.php');

if (!isset($_SESSION['fullname'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$fullname   = $conn->real_escape_string($_POST['fullname']);
$purok      = $conn->real_escape_string($_POST['purok']);
$age        = $conn->real_escape_string($_POST['age']);
$res_years  = $conn->real_escape_string($_POST['resident_years']);
$req        = $conn->real_escape_string($_POST['requirement']);
$cert_name  = $conn->real_escape_string($_POST['certificate_name']);
$user_email = $conn->real_escape_string($_POST['email']);
$fname      = $conn->real_escape_string($_POST['fname']);

// Check if the user's status is "on hold"
$statusCheckQuery = "SELECT status FROM tblresident_requested WHERE email = '$user_email' LIMIT 1";
$statusCheckResult = $conn->query($statusCheckQuery);

if (!$statusCheckResult) {
    $_SESSION['message'] = 'Error checking status: ' . $conn->error;
    $_SESSION['success'] = 'danger';
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

if ($statusCheckResult->num_rows > 0) {
    $statusData = $statusCheckResult->fetch_assoc();
    
    if ($statusData['status'] === 'on hold' || $statusData['status'] === 'claimed' || $statusData['status'] === 'rejected') {
        $checkApprovedQuery = "SELECT status FROM tblresident_requested WHERE email = '$user_email' AND status = 'approved' LIMIT 1";
        $checkApprovedResult = $conn->query($checkApprovedQuery);

        if (!$checkApprovedResult) {
            $_SESSION['message'] = 'Error checking approval status: ' . $conn->error;
            $_SESSION['success'] = 'danger';
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }

        $checkApprovedData = $checkApprovedResult->fetch_assoc();

        if ($checkApprovedData['status'] !== 'approved') {
            // Rest of the code...
            $checkDuplicateQuery = "SELECT COUNT(*) as count FROM tblresident_requested WHERE email = '$user_email' AND requirement = '$req' AND status = 'on hold'";
            $checkDuplicateResult = $conn->query($checkDuplicateQuery);

            if (!$checkDuplicateResult) {
                $_SESSION['message'] = 'Error checking duplicate request: ' . $conn->error;
                $_SESSION['success'] = 'danger';
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit();
            }

            $checkDuplicateData = $checkDuplicateResult->fetch_assoc();

            if ($checkDuplicateData['count'] < 1) {
                $insert_query = "INSERT INTO tblresidency(`fullname`,`cert_name`,`age`, `purok`, `resident_year`, `requirement`,`requester`, `email`) VALUES ('$fullname', '$cert_name',  '$age', '$purok', '$res_years', '$req', '$fname','$user_email')";
                $result_resident = $conn->query($insert_query);

                if ($result_resident === true) {
                    $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`) VALUES ('$fname', '$cert_name','$user_email', '$purok','$req', 'on hold')";
                    $result_requested = $conn->query($insert_requested);

                    if ($result_requested === true) {
                        $_SESSION['message'] = 'You have requested a certificate of residency that has been sent!';
                        $_SESSION['success'] = 'success';
                    } else {
                        $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
                        $_SESSION['success'] = 'danger';
                    }
                } else {
                    $_SESSION['message'] = 'Something went wrong while inserting into tblresidency: ' . $conn->error;
                    $_SESSION['success'] = 'danger';
                }
            } else {
                $checkExistingClaimedRequestQuery = "SELECT COUNT(*) as ClaimedCount FROM tblresident_requested WHERE email = '$user_email' AND requirement = '$req' AND status = 'claimed'";
                $checkExistingClaimedRequestResult = $conn->query($checkExistingClaimedRequestQuery);

                if (!$checkExistingClaimedRequestResult) {
                    $_SESSION['message'] = 'Error checking claimed request: ' . $conn->error;
                    $_SESSION['success'] = 'danger';
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    exit();
                }

                $checkExistingClaimedRequestData = $checkExistingClaimedRequestResult->fetch_assoc();

                if ($checkExistingClaimedRequestData['ClaimedCount'] < 1) {
                    $_SESSION['message'] = 'You have already requested a certificate with the same requirement. Please wait until your previous request is processed.';
                    $_SESSION['success'] = 'info';
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    exit();
                }

                // Allow the user to add another request with the same requirement
                $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`) VALUES ('$fname', '$cert_name','$user_email', '$purok','$req', 'on hold')";
                $result_requested = $conn->query($insert_requested);

                if ($result_requested === true) {
                    $_SESSION['message'] = 'You have requested a certificate of residency with the same requirement that has been sent!';
                    $_SESSION['success'] = 'success';
                } else {
                    $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
                    $_SESSION['success'] = 'danger';
                }
            }
        } else {
            $_SESSION['message'] = 'Your account is in "approved" status. You cannot request certificates.';
            $_SESSION['success'] = 'info';
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }
    } else {
        $_SESSION['message'] = 'Your account is not in an allowed status. You cannot request certificates.';
        $_SESSION['success'] = 'info';
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
} else {
    // First-time insertion or "on hold" in tblresident, allow request
    $checkResidentQuery = "SELECT residency_status FROM tblresident WHERE email = '$user_email' LIMIT 1";
    $checkResidentResult = $conn->query($checkResidentQuery);

    if (!$checkResidentResult) {
        $_SESSION['message'] = 'Error checking residency status: ' . $conn->error;
        $_SESSION['success'] = 'danger';
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }

    $checkResidentData = $checkResidentResult->fetch_assoc();

    if ($checkResidentData['residency_status'] === 'on hold') {
        $_SESSION['message'] = 'Your account is on hold status and cannot proceed to request certifications. Please wait until your purok leader has permitted your resident identification. Thank you!';
        $_SESSION['success'] = 'info';
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }

    $insert_query = "INSERT INTO tblresidency(`fullname`,`cert_name`,`age`, `purok`, `resident_year`, `requirement`,`requester`, `email`) VALUES ('$fullname', '$cert_name',  '$age', '$purok', '$res_years', '$req', '$fname','$user_email')";
    $result_resident = $conn->query($insert_query);

    if ($result_resident === true) {
        $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`) VALUES ('$fname', '$cert_name','$user_email', '$purok','$req', 'on hold')";
        $result_requested = $conn->query($insert_requested);

        if ($result_requested === true) {
            $_SESSION['message'] = 'You have requested a certificate of residency that has been sent!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Something went wrong while inserting into tblresidency: ' . $conn->error;
        $_SESSION['success'] = 'danger';
    }
}

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

$conn->close();
?>



<script>
    function View(that){
        id          = $(that).attr('data-id');
        pic         = $(that).attr('data-img');
        nat_id 		= $(that).attr('data-national');
        fname 		= $(that).attr('data-fname');
        mname 		= $(that).attr('data-mname');
        lname 		= $(that).attr('data-lname');
        address 	= $(that).attr('data-address');
        bplace 	    = $(that).attr('data-bplace');
        bdate 		= $(that).attr('data-bdate');
        age 		= $(that).attr('data-age');
        cstatus 	= $(that).attr('data-cstatus');
        gender 	    = $(that).attr('data-gender');
        purok 		= $(that).attr('data-purok');
        vstatus 	= $(that).attr('data-vstatus');
        email 	    = $(that).attr('data-email');
        number 	    = $(that).attr('data-number');
        taxno 	    = $(that).attr('data-taxno');
        citi 	    = $(that).attr('data-citi');
        occu 	    = $(that).attr('data-occu');
        dead 	    = $(that).attr('data-dead');
        remarks 	= $(that).attr('data-remarks');
        purpose 	= $(that).attr('data-purpose');

        $('#res_id').val(id);
        $('#nat_id').val(nat_id);
        $('#fname').val(fname);
        $('#mname').val(mname);
        $('#lname').val(lname);
        $('#address').val(address);
        $('#bplace').val(bplace);
        $('#bdate').val(bdate);
        $('#age').val(age);
        $('#cstatus').val(cstatus);
        $('#gender').val(gender);
        $('#purok').val(purok);
        $('#vstatus').val(vstatus);
        $('#taxno').val(taxno);
        $('#email').val(email);
        $('#number').val(number);
        $('#occupation').val(occu);
        $('#citizenship').val(citi);
        $('#remarks').val(remarks);
        $('#purpose').val(purpose);

        if(dead==1){
            $("#alive").prop("checked", true);
        }else{
            $("#dead").prop("checked", true);
        }

        var str = pic;
        var n = str.includes("data:image");
        if(!n){
            pic = 'assets/uploads/resident_profile/'+pic;
        }
        $('#image').attr('src', pic);
    }
</script>



                                        <!--<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <div class="d-flex align-items-center align-items-md-center flex-column flex-md-row mb-2">
                                                <div class="col-sm-12 col-md-2">
                                                    <label for="fromDate">From:</label>
                                                    <input type="date" class="form-control" id="fromDate" name="fromDate" value="<?php echo isset($_POST['fromDate']) ? htmlspecialchars($_POST['fromDate']) : date('Y-m-d'); ?>">
                                                </div>
                                                <div class="col-sm-12 col-md-2">
                                                    <label for="toDate">To:</label>
                                                    <input type="date" class="form-control" id="toDate" name="toDate" value="<?php echo isset($_POST['toDate']) ? htmlspecialchars($_POST['toDate']) : date('Y-m-d'); ?>">
                                                </div>
                                                <div class="col-sm-12 col-md-2">
                                                    <label for="dateType">Date Type:</label>
                                                    <select class="form-control" id="dateType" name="dateType">
                                                        <option value="weekly" <?php if (isset($_POST['dateType']) && $_POST['dateType'] === 'weekly') echo 'selected'; ?>>By Week</option>
                                                        <option value="monthly" <?php if (isset($_POST['dateType']) && $_POST['dateType'] === 'monthly') echo 'selected'; ?>>By Month</option>
                                                        <option value="yearly" <?php if (isset($_POST['dateType']) && $_POST['dateType'] === 'yearly') echo 'selected'; ?>>By Year</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 col-md-3">
                                                    <label for="documentType">Document Type:</label>
                                                    <select class="form-control" id="documentType" name="documentType">
                                                        <option value="All" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'All') echo 'selected'; ?>>All</option>
                                                        <option value="Barangay Clearance" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Barangay Clearance') echo 'selected'; ?>>Barangay Clearance</option>
                                                        <option value="Certificate of Residency" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Residency') echo 'selected'; ?>>Certificate of Residency</option>
                                                        <option value="Certificate of Indigency" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Indigency') echo 'selected'; ?>>Certificate of Indigency</option>
                                                        <option value="Business Permit" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Business Permit') echo 'selected'; ?>>Business Permit</option>
                                                        <option value="Certificate of Good Moral" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Good Moral') echo 'selected'; ?>>Certificate of Good Moral</option>
                                                        <option value="Certificate of Birth " <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Birth ') echo 'selected'; ?>>Certificate of Birth</option>
                                                        <option value="Certificate of Oath Taking" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Oath Taking') echo 'selected'; ?>>Certificate of Oath Taking</option>
                                                        <option value="First Time Jobseekers" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'First Time Jobseekers') echo 'selected'; ?>>First Time Jobseekers</option>
                                                        <option value="Certificate of Live In" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Live In') echo 'selected'; ?>>Certificate of Live In</option>
                                                        <option value="Barangay Identification" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Barangay Identification') echo 'selected'; ?>>Barangay Identification</option>
                                                        <option value="Certificate of Death" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Death') echo 'selected'; ?>>Certificate of Death</option>
                                                        <option value="Family Home Estate" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Family Home Estate') echo 'selected'; ?>>Family Home Estate</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 col-md-2">
                                                    <label> </label><br>
                                                    <button type="submit" class="applyFilterBtn btn btn-primary" style="padding: 10px 30px; border-radius: 5px;">Apply Filter</button>
                                                </div>
                                            </div>
                                        </form>-->
                                        <script>
    document.getElementById("PiepdfExportBtn").addEventListener("click", function () {
      var doc = new jsPDF();
      var piechartRow = document.getElementById("chartRowPie");
      var piefromDate = document.getElementById("piefromDate").value;
      var pietoDate = document.getElementById("pietoDate").value;
      var certificateType = document.getElementById("certificateType").value;

      var pietitle = "Overview Pie Chart Visualization Reports";
      doc.setFontSize(18);
      doc.text(pietitle, 10, 10);

      var PiecurrentDate = new Date().toLocaleDateString();
      doc.setFontSize(12);
      doc.text("Today Date: " + PiecurrentDate, 10, 20);
      doc.text("Range Date: " + piefromDate + " to " + pietoDate, 10, 30);
      doc.text("Certificate Type: " + certificateType, 10, 40);

      var width = 200;
      var height = 150;

      html2canvas(piechartRow, { scale: 2 }).then(function (canvas) {
        var pieimgData = canvas.toDataURL("image/png");
        doc.addImage(pieimgData, "PNG", 10, 150, width, height);

        doc.save("Dashboard-Pie-Chart.pdf");
      });
    });
</script>

<div id="DeactivateDeleteModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Deactivate or delete your account.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="model/delete_account.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <span class="mt-4 mb-5">Temporarily deactivate or pemanently delete your account.</span><br>
                            <form method="POST" action="model/delete_account.php" enctype="multipart/form-data">
                                <a href="" class="form-control mt-3 mb-2 btn btn-danger" type="button" data-toggle="modal" data-target="#deleteConfirmationModal" style="text-decoration: none;">
                                    <span class="link-collapse">Delete Account</span>
                                </a>
                            </form>
                            <form method="POST" action="model/deactivate_account.php" enctype="multipart/form-data">
                                <a href="" class="form-control btn btn-primary" type="button" data-toggle="modal" data-target="#deactivationConfirmationModal" style="text-decoration: none;">
                                    <span class="link-collapse">Deactivate Account</span>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </form>
        </div>
    </div>
</div>
<div id="deleteConfirmationModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Delete Account Permanently</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="model/delete_account.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <p class="fw-bold" style="font-size: 16px;">Delete Account</p>
                    <label><strong>Deleting your account is permanently.</strong> When you delete your account, you've won't be able to retrieve the information and the transaction you shared
                    in the CertiFast Portal.</label>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="email" value="<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?>" class="input" readonly>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a class="text-white btn btn-danger" type="submit" data-toggle="modal" value="Delete" data-target="#passwordConfirmationModal" name="submit">Delete</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="deactivationConfirmationModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Delete Account Permanently</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="model/deactivate_account.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <p class="fw-bold" style="font-size: 16px;">Deactive Account</p>
                    <label><strong>Deactivating your account is temporary.</strong> Your account will disabled and your name, photos and your transactions will be removed.</label>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="email" value="<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?>" class="input" readonly>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a class="text-white btn btn-danger" type="submit" data-toggle="modal" value="Deactivate" data-target="#passwordConfirmationModal" name="submit">Deactivate</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="passwordConfirmationModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">For your security, please re-enter your password to continue.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="model/delete_account.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter your password" name="password" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a class="text-white btn btn-danger" type="button" data-toggle="modal" value="Confirm" data-target="#confirmpasswordModal" name="submit">Confirm</a>
                </div>
            </form>
        </div>
    </div>
</div>
<a href="" class="form-control mt-3 mb-2 btn btn-danger" type="submit" data-target="#deleteConfirmationModal" data-toggle="modal" style="text-decoration: none;">
                    <span class="link-collapse">Delete Account</span>
                </a>
                <a href="" class="form-control btn btn-primary" type="submit" data-target="#deactivationConfirmationModal" data-toggle="modal" style="text-decoration: none;">
                    <span class="link-collapse">Deactivate Account</span>
                </a>

                <div id="DeactivateDeleteModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Deactivate or delete your account.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-group text-left">
                        <span class="mt-4 mb-5">Deactivating or deleting your CertiFast account. If you want to take a break from CertiFast, you can deactivate your account. Please let us know if you want to permanently delete your CertiFast account.</span>
                        <div class="form-control mt-2">
                            <input type="radio" name="action" value="deactivation" class="radio-input"> 
                            <strong>Deactivation Account</strong>
                            <div class="text-muted mt-2">
                                <p>This will temporarily deactivate your account. Your account will be disabled, and your name, photos, and transactions will be removed.</p>
                            </div>
                        </div>
                        <div class="form-control mt-2">
                            <input type="radio" name="action" value="delete" class="radio-input"> 
                            <strong>Delete Account</strong>
                            <div class="text-muted mt-2">
                                <p>This will permanently delete your account. When you delete your account, you won't be able to retrieve the information and transactions you shared in the CertiFast Portal.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer mt-2 d-flex justify-content-center">
                <a href="" class="btn btn-primary mr-2" type="button" data-target="#passwordConfirmationModal" data-toggle="modal" style="text-decoration: none;">
                    <span class="link-collapse">Confirm</span>
                </a>
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">
                    <span class="link-collapse">Cancel</span>
                </button>
            </div>
        </div>
    </div>
</div>


<div id="deleteConfirmationModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Delete Account Permanently</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="model/delete_account.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <p class="fw-bold" style="font-size: 16px;">Delete Account</p>
                    <label><strong>Deleting your account is permanently.</strong> When you delete your account, you've won't be able to retrieve the information and the transaction you shared
                    in the CertiFast Portal.</label>
                    <a href="" class="form-control mt-3 mb-2 btn btn-danger" value="Delete" type="submit" data-toggle="modal" style="text-decoration: none;">
                        <span class="link-collapse">Delete Account</span>
                    </a>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="email" value="<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?>" class="input" readonly>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="deactivationConfirmationModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Deactivation Account Temporary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="model/deactivate_account.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <p class="fw-bold" style="font-size: 16px;">Deactivation Account</p>
                    <label><strong>Deactivating your account is temporary.</strong> Your account will disabled and your name, photos and your transactions will be removed.</label>
                    <a href="" class="form-control mt-3 mb-2 btn btn-primary" value="Deactivate" type="submit" data-toggle="modal" style="text-decoration: none;">
                        <span class="link-collapse">Deactivate Account</span>
                    </a>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="email" value="<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?>" class="input" readonly>
                </div>
            </form>
        </div>
    </div>
</div>