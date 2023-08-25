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

// Check if email is valid and residency status is approved
$residencyStatusCheckQuery = "SELECT COUNT(*) AS status_count, residency_status FROM tblresident WHERE email = '$user_email'";
$residencyStatusCheckResult = $conn->query($residencyStatusCheckQuery);
$residencyStatusCheckData = $residencyStatusCheckResult->fetch_assoc();

if ($residencyStatusCheckData['residency_status'] === 0) {
    $_SESSION['message'] = 'Your account is not verified for requesting certificates. Please register your personal information first.';
    $_SESSION['success'] = 'danger';
    header("Location: ../resident_profiling.php");
    exit();
}

if ($residencyStatusCheckData['residency_status'] === 'on hold') {
    $_SESSION['message'] = 'Your account is not been verified by your respected Purok Leader. Please inform your purok leader for approval.';
    $_SESSION['success'] = 'danger';
    header("Location: ../resident_profiling.php");
    exit();
} elseif ($residencyStatusCheckData['residency_status'] !== 'approved') {
    $_SESSION['message'] = 'Your account is not verified for requesting certificates. Please registered your account first.';
    $_SESSION['success'] = 'danger';
    header("Location: ../resident_profiling.php");
    exit();
}

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
        $checkApprovedQuery = "SELECT status FROM tblresident_requested WHERE email = '$user_email' AND certificate_name = '$cert_name' AND status = 'approved' LIMIT 1";
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
                $checkExistingClaimedRequestQuery = "SELECT COUNT(*) as ClaimedCount FROM tblresident_requested WHERE email = '$user_email' AND certificate_name = '$cert_name'";
                $checkExistingClaimedRequestResult = $conn->query($checkExistingClaimedRequestQuery);

                if (!$checkExistingClaimedRequestResult) {
                    $_SESSION['message'] = 'Error checking claimed request: ' . $conn->error;
                    $_SESSION['success'] = 'danger';
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    exit();
                }

                $checkExistingClaimedRequestData = $checkExistingClaimedRequestResult->fetch_assoc();

                if ($checkExistingClaimedRequestData['ClaimedCount'] > 0) {
                    $_SESSION['message'] = 'You have already requested a certificate with the same requirement. Please wait until your previous request is processed.';
                    $_SESSION['success'] = 'info';
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    exit();
                }

                // Allow the user to add another request with the same requirement
                $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`) VALUES ('$fname', '$cert_name','$user_email', '$purok','$req', 'on hold')";
                $result_requested = $conn->query($insert_requested);

                if ($result_requested === true) {
                    $_SESSION['message'] = 'You have requested a certificate of residency with the same requirement successfully!';
                    $_SESSION['success'] = 'success';
                } else {
                    $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
                    $_SESSION['success'] = 'danger';
                }
            }
        } else {
            $_SESSION['message'] = 'You have reach a maximum request of certificates of residency. Please double-check your certificates status or go to the Barangay Office for clarification.';
            $_SESSION['success'] = 'info';
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }
    } else {
        $_SESSION['message'] = 'You cannot request a certificates again when you have already have previously requested with same requirement. Please check your Certificates Status or visit Barangay Office for clarifications.';
        $_SESSION['success'] = 'info';
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
} else {
   // First-time insertion or "on hold" in tblresident, allow request
$checkResidentQuery = "SELECT residency_status FROM tblresident WHERE email = '$user_email'";
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
    header("Location: ../resident_profiling.php");
    exit();
}

// Check if email and purok match in tbl_user_resident
$matchCheckQuery = "SELECT COUNT(*) AS match_count FROM tblresident WHERE email = '$user_email' AND purok = '$purok'";
$matchCheckResult = $conn->query($matchCheckQuery);
$matchCheckData = $matchCheckResult->fetch_assoc();

if ($matchCheckData['match_count'] === 0) {
    $_SESSION['message'] = 'Your account has not been fully registered. Please registered first your account in here.';
    $_SESSION['success'] = 'danger';
    header("Location: ../resident_profiling.php");
    exit();
}

// Insert data into tblresidency
$insert_query = "INSERT INTO tblresidency(`fullname`,`cert_name`,`age`, `purok`, `resident_year`, `requirement`,`requester`, `email`) VALUES ('$fullname', '$cert_name',  '$age', '$purok', '$res_years', '$req', '$fname','$user_email')";
$result_resident = $conn->query($insert_query);

if ($result_resident === true) {
    // Insert data into tblresident_requested
    $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`) VALUES ('$fname', '$cert_name','$user_email', '$purok','$req', 'on hold')";
    $result_requested = $conn->query($insert_requested);

    if ($result_requested === true) {
        $_SESSION['message'] = 'You have requested a certificate of residency successfully!';
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
