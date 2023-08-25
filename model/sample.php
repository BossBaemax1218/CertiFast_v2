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