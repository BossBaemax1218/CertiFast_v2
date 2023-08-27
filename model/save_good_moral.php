<?php 
include('../server/server.php');

// Check if the user is not logged in
if (!isset($_SESSION['fullname'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

// Get form data
$fullname   = $conn->real_escape_string($_POST['fullname']);
$purok      = $conn->real_escape_string($_POST['purok']);
$cert_name  = $conn->real_escape_string($_POST['certificate_name']);
$taxno      = $conn->real_escape_string($_POST['taxno']);
$user_email = $conn->real_escape_string($_POST['email']);
$fname      = $conn->real_escape_string($_POST['fname']);
$req        = $conn->real_escape_string($_POST['requirement']);

// Check residency status of the user
$residencyStatusCheckQuery = "SELECT COUNT(*) AS status_count, residency_status FROM tblresident WHERE email = '$user_email' LIMIT 1";
$residencyStatusCheckResult = $conn->query($residencyStatusCheckQuery);
$residencyStatusCheckData = $residencyStatusCheckResult->fetch_assoc();

// If user's residency is not approved or verified
if ($residencyStatusCheckData['status_count'] === 0 || $residencyStatusCheckData['residency_status'] !== 'approved') {
    $_SESSION['message'] = 'Your account is not verified for requesting certificates. Please register and get verified.';
    $_SESSION['success'] = 'danger';
    header("Location: ../resident_profiling.php");
    exit();
}

// Check the status of previous requests
$statusCheckQuery = "SELECT status FROM tblresident_requested WHERE email = '$user_email' AND certificate_name = '$cert_name' LIMIT 1";
$statusCheckResult = $conn->query($statusCheckQuery);

if (!$statusCheckResult) {
    $_SESSION['message'] = 'Error checking status: ' . $conn->error;
    $_SESSION['success'] = 'danger';
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

// If there are previous requests
if ($statusCheckResult->num_rows > 0) {
    $statusData = $statusCheckResult->fetch_assoc();

    // If the request is on hold, claimed, or rejected
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

        // If the request is not yet approved
        if ($checkApprovedData['status'] !== 'approved') {
            $checkDuplicateQuery = "SELECT COUNT(*) as count FROM tblresident_requested WHERE email = '$user_email' AND certificate_name = '$cert_name' AND status = 'on hold'";
            $checkDuplicateResult = $conn->query($checkDuplicateQuery);

            if (!$checkDuplicateResult) {
                $_SESSION['message'] = 'Error checking duplicate request: ' . $conn->error;
                $_SESSION['success'] = 'danger';
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit();
            }

            $checkDuplicateData = $checkDuplicateResult->fetch_assoc();

            // If no duplicate requests
            if ($checkDuplicateData['count'] < 1) {
                // Insert into tblgood_moral table
                $insert_query = "INSERT INTO tblgood_moral(`fullname`,`purok`, `cert_name`, `requester`, `email`, `requirement`, `taxno`) 
                                VALUES ('$fullname', '$purok', '$cert_name', '$fname', '$user_email', '$req', '$taxno')";
                $result_resident = $conn->query($insert_query);

                if ($result_resident === true) {
                    // Insert into tblresident_requested table
                    $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`) 
                                         VALUES ('$fname', '$cert_name','$user_email', '$purok', '$req', 'on hold')";
                    $result_requested = $conn->query($insert_requested);

                    if ($result_requested === true) {
                        $_SESSION['message'] = 'You have requested a certificate of good moral that has been sent!';
                        $_SESSION['success'] = 'success';
                    } else {
                        $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
                        $_SESSION['success'] = 'danger';
                    }
                } else {
                    $_SESSION['message'] = 'Something went wrong while inserting into tblgood_moral: ' . $conn->error;
                    $_SESSION['success'] = 'danger';
                }
            } else {
                // Check for existing claimed requests
                $checkExistingClaimedRequestQuery = "SELECT COUNT(*) as ClaimedCount FROM tblresident_requested WHERE email = '$user_email' AND certificate_name = '$cert_name'";
                $checkExistingClaimedRequestResult = $conn->query($checkExistingClaimedRequestQuery);

                if (!$checkExistingClaimedRequestResult) {
                    $_SESSION['message'] = 'Error checking claimed request: ' . $conn->error;
                    $_SESSION['success'] = 'danger';
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    exit();
                }

                $checkExistingClaimedRequestData = $checkExistingClaimedRequestResult->fetch_assoc();

                // If there are existing claimed requests
                if ($checkExistingClaimedRequestData['ClaimedCount'] > 0) {
                    $_SESSION['message'] = 'You cannot request a certificate again when you have already previously requested. Please check your Certificates Status or visit the Barangay Office for clarifications.';
                    $_SESSION['success'] = 'info';
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    exit();
                }

                // Insert into tblresident_requested table
                $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`) 
                                     VALUES ('$fname', '$cert_name','$user_email', '$purok', '$req', 'on hold')";
                $result_requested = $conn->query($insert_requested);

                if ($result_requested === true) {
                    $_SESSION['message'] = 'You have requested a certificate of good moral with the same requirement successfully!';
                    $_SESSION['success'] = 'success';
                } else {
                    $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
                    $_SESSION['success'] = 'danger';
                }
            }
        } else {
            $_SESSION['message'] = 'You have reached the maximum request of certificates of good moral. Please check your certificates status or visit the Barangay Office for clarification.';
            $_SESSION['success'] = 'info';
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }
    } else {
        $_SESSION['message'] = 'You have already requested a certificate with the same requirement. Please wait until your previous request is processed.';
        $_SESSION['success'] = 'info';
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
} else {
    // Check residency status of the user
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

    // Check if the user's purok matches
    $matchCheckQuery = "SELECT COUNT(*) AS match_count FROM tblresident WHERE email = '$user_email' AND purok = '$purok'";
    $matchCheckResult = $conn->query($matchCheckQuery);
    $matchCheckData = $matchCheckResult->fetch_assoc();

    if ($matchCheckData['match_count'] === 0) {
        $_SESSION['message'] = 'Your account has not been fully registered. Please register first your account here.';
        $_SESSION['success'] = 'danger';
        header("Location: ../resident_profiling.php");
        exit();
    }

    // Insert into tblgood_moral table
    $insert_query = "INSERT INTO tblgood_moral(`fullname`,`purok`, `cert_name`, `requester`, `email`, `requirement`, `taxno`) 
        VALUES ('$fullname', '$purok', '$cert_name', '$fname', '$user_email', '$req', '$taxno')";
    $result_resident = $conn->query($insert_query);

    if ($result_resident === true) {
        // Insert into tblresident_requested table
        $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`) 
                             VALUES ('$fname', '$cert_name','$user_email', '$purok', '$req', 'on hold')";
        $result_requested = $conn->query($insert_requested);

        if ($result_requested === true) {
            $_SESSION['message'] = 'You have requested a certificate of good moral successfully!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Something went wrong while inserting into tblgood_moral: ' . $conn->error;
        $_SESSION['success'] = 'danger';
    }
}

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

$conn->close();
?>
