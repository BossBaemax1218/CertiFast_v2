<?php
include('../server/server.php');

if (!isset($_SESSION['fullname'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}

$fam1 = $conn->real_escape_string($_POST['fam_1']);
$fam2 = $conn->real_escape_string($_POST['fam_2']);
$fam3 = $conn->real_escape_string($_POST['fam_3']);
$fam4 = $conn->real_escape_string($_POST['fam_4']);
$fam5 = $conn->real_escape_string($_POST['fam_5']);
$purok = $conn->real_escape_string($_POST['purok']);
$tct = $conn->real_escape_string($_POST['tctno']);
$req = $conn->real_escape_string($_POST['requirements']);
$cert_name = $conn->real_escape_string($_POST['certificate_name']);
$user_email = $conn->real_escape_string($_POST['email']);
$fullname = $conn->real_escape_string($_POST['fullname']);

if (!empty($fam1) && !empty($fam2) && !empty($fam3) && !empty($fam4) && !empty($fam5) && !empty($tct) && !empty($req)) {

    $residencyStatusCheckQuery = "SELECT COUNT(*) AS status_count, residency_status FROM tblresident WHERE email = '$user_email' LIMIT 1";
    $residencyStatusCheckResult = $conn->query($residencyStatusCheckQuery);
    $residencyStatusCheckData = $residencyStatusCheckResult->fetch_assoc();

    if ($residencyStatusCheckData['status_count'] === 0) {
        $_SESSION['message'] = 'Your account is not verified for requesting certificates. Please register your personal information first.';
        $_SESSION['success'] = 'danger';
        header("Location: ../resident_profiling.php");
        exit();
    }

    if ($residencyStatusCheckData['residency_status'] === 'on hold') {
        $_SESSION['message'] = 'Your account is not verified by your respected Purok Leader. Please inform your purok leader for approval.';
        $_SESSION['success'] = 'danger';
        header("Location: ../resident_profiling.php");
        exit();
    } elseif ($residencyStatusCheckData['residency_status'] !== 'approved') {
        $_SESSION['message'] = 'Your account is not verified for requesting certificates. Please register your account first.';
        $_SESSION['success'] = 'danger';
        header("Location: ../resident_profiling.php");
        exit();
    }

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
                $checkDuplicateQuery = "SELECT COUNT(*) as count FROM tblresident_requested WHERE email = '$user_email' AND requirement = '$req' AND certificate_name = '$cert_name' AND status = 'on hold'";
                $checkDuplicateResult = $conn->query($checkDuplicateQuery);

                if (!$checkDuplicateResult) {
                    $_SESSION['message'] = 'Error checking duplicate request: ' . $conn->error;
                    $_SESSION['success'] = 'danger';
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    exit();
                }

                $checkDuplicateData = $checkDuplicateResult->fetch_assoc();

                if ($checkDuplicateData['count'] < 1) {
                    $insert_query = "INSERT INTO tblfamily_tax(`fam_1`, `fam_2`, `fam_3`, `fam_4`, `fam_5`,`purok`, `tctno`, `cert_name`, `requirements`, `requester`, `email`)
                                        VALUES ('$fam1', '$fam2', '$fam3', '$fam4', '$fam5', '$purok', '$tct', '$cert_name', '$req','$fullname', '$user_email')";
                    $result_resident = $conn->query($insert_query);

                    if ($result_resident === true) {
                        $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`)
                                            VALUES ('$fullname', '$cert_name', '$user_email', '$purok', '$req', 'on hold')";
                        $result_requested = $conn->query($insert_requested);

                        if ($result_requested === true) {
                            $_SESSION['message'] = 'You have requested a certificate of family estate tax that has been sent!';
                            $_SESSION['success'] = 'success';
                        } else {
                            $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
                            $_SESSION['success'] = 'danger';
                        }
                    } else {
                        $_SESSION['message'] = 'Something went wrong while inserting into tblfamily_tax: ' . $conn->error;
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

                    $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`)
                                        VALUES ('$fullname', '$cert_name', '$user_email', '$purok', '$req', 'on hold')";
                    $result_requested = $conn->query($insert_requested);

                    if ($result_requested === true) {
                        $_SESSION['message'] = 'You have requested a certificate of family estate tax with the same requirement successfully!';
                        $_SESSION['success'] = 'success';
                    } else {
                        $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
                        $_SESSION['success'] = 'danger';
                    }
                }
            } else {
                $_SESSION['message'] = 'You have reached the maximum request of certificates of family estate tax. Please double-check your certificates status or go to the Barangay Office for clarification.';
                $_SESSION['success'] = 'info';
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit();
            }
        } else {
            $_SESSION['message'] = 'You cannot request a certificate again when you have already previously requested with the same requirement. Please check your Certificates Status or visit the Barangay Office for clarifications.';
            $_SESSION['success'] = 'info';
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }
    } else {
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

        $matchCheckQuery = "SELECT COUNT(*) AS match_count FROM tblresident WHERE email = '$user_email'";
        $matchCheckResult = $conn->query($matchCheckQuery);
        $matchCheckData = $matchCheckResult->fetch_assoc();

        if ($matchCheckData['match_count'] === 0) {
            $_SESSION['message'] = 'Your account has not been fully registered. Please register first your account here.';
            $_SESSION['success'] = 'danger';
            header("Location: ../resident_profiling.php");
            exit();
        }

        $insert_query = "INSERT INTO tblfamily_tax(`fam_1`, `fam_2`, `fam_3`, `fam_4`, `fam_5`,`purok`, `tctno`, `cert_name`, `requirements`, `requester`, `email`)
                VALUES ('$fam1', '$fam2', '$fam3', '$fam4', '$fam5', '$purok', '$tct', '$cert_name', '$req','$fullname', '$user_email')";
        $result_resident = $conn->query($insert_query);

        if ($result_resident === true) {
            $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`)
                                VALUES ('$fullname', '$cert_name', '$user_email', '$purok', '$req', 'on hold')";
            $result_requested = $conn->query($insert_requested);

            if ($result_requested === true) {
                $_SESSION['message'] = 'You have requested a certificate of family estate tax successfully!';
                $_SESSION['success'] = 'success';
            } else {
                $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
                $_SESSION['success'] = 'danger';
            }
        } else {
            $_SESSION['message'] = 'Something went wrong while inserting into tblfamily_tax: ' . $conn->error;
            $_SESSION['success'] = 'danger';
        }
    }
} else {
    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

$conn->close();
?>
