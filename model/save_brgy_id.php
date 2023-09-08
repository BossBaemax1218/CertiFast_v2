<?php
include('../server/server.php');

if (!isset($_SESSION['fullname'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}

$id = $conn->real_escape_string($_POST['id_no']);
$owner = $conn->real_escape_string($_POST['fullname']);
$bdate = $conn->real_escape_string($_POST['birthdate']);
$purok = $conn->real_escape_string($_POST['purok']);
$precint = $conn->real_escape_string($_POST['precintno']);
$phone = $conn->real_escape_string($_POST['phone']);
$contact = $conn->real_escape_string($_POST['contact_number']);
$guardian = $conn->real_escape_string($_POST['guardian']);
$rship = $conn->real_escape_string($_POST['relationship']);
$cert_name = $conn->real_escape_string($_POST['certificate_name']);
$fname = $conn->real_escape_string($_POST['fname']);
$user_email = $conn->real_escape_string($_POST['email']);
$req = $conn->real_escape_string($_POST['requirement']);

// Check residency status
$residencyStatusCheckQuery = "SELECT COUNT(*) AS status_count, residency_status FROM tblresident WHERE email = '$user_email' LIMIT 1";
$residencyStatusCheckResult = $conn->query($residencyStatusCheckQuery);
$residencyStatusCheckData = $residencyStatusCheckResult->fetch_assoc();

if ($residencyStatusCheckData['status_count'] === 0 || $residencyStatusCheckData['residency_status'] === 'on hold') {
    $_SESSION['message'] = 'Your account is not verified or is on hold. Please register your personal information and get verified.';
    $_SESSION['success'] = 'danger';
    header("Location: ../resident_profiling.php");
    exit();
}

// Check existing requests
$statusCheckQuery = "SELECT status FROM tblresident_requested WHERE email = '$user_email' AND certificate_name = '$cert_name' LIMIT 1";
$statusCheckResult = $conn->query($statusCheckQuery);

if (!$statusCheckResult) {
    $_SESSION['message'] = 'Error checking status: ' . $conn->error;
    $_SESSION['success'] = 'danger';
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

if ($statusCheckResult->num_rows > 0) {
    $statusData = $statusCheckResult->fetch_assoc();

    // Handle different request statuses
    if (in_array($statusData['status'], ['on hold', 'claimed', 'rejected'])) {
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
            $checkDuplicateQuery = "SELECT COUNT(*) as count FROM tblresident_requested WHERE email = '$user_email' AND certificate_name = '$cert_name' AND status = 'on hold'";
            $checkDuplicateResult = $conn->query($checkDuplicateQuery);

            if (!$checkDuplicateResult) {
                $_SESSION['message'] = 'Error checking duplicate request: ' . $conn->error;
                $_SESSION['success'] = 'danger';
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit();
            }

            $checkDuplicateData = $checkDuplicateResult->fetch_assoc();

            if ($checkDuplicateData['count'] < 1) {
                $insert_query = "INSERT INTO tblbrgy_id(`id_no`, `fullname`, `birthdate`, `purok`, `precintno`, `phone`, `contact_number`, `guardian`, `relationship`, `cert_name`, `requirement`, `requester`, `email`) 
                                VALUES ('$id', '$owner', '$bdate', '$purok', '$precint', '$phone', '$contact', '$guardian', '$rship', '$cert_name', '$req', '$fname', '$user_email')";
                $result_resident = $conn->query($insert_query);

                if ($result_resident === true) {
                    $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`) 
                                        VALUES ('$fname', '$cert_name', '$user_email', '$purok', '$req', 'on hold')";
                    $result_requested = $conn->query($insert_requested);

                    if ($result_requested === true) {
                        $_SESSION['message'] = 'You have requested a barangay ID that has been sent!';
                        $_SESSION['success'] = 'success';
                    } else {
                        $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
                        $_SESSION['success'] = 'danger';
                    }
                } else {
                    $_SESSION['message'] = 'Something went wrong while inserting into tblbrgy_id: ' . $conn->error;
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
                    $_SESSION['message'] = 'Ikaw ay nakapag-request na ng isang sertipikado na may parehong dahilan o layunin. Mangyaring kunin ang mga na-aprubahang sertipikado sa Opisina ng Barangay Los Amigos.';
                    $_SESSION['success'] = 'info';
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    exit();
                }

                $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`) 
                                VALUES ('$fname', '$cert_name', '$user_email', '$purok', '$req', 'on hold')";
                $result_requested = $conn->query($insert_requested);

                if ($result_requested === true) {
                    $_SESSION['message'] = 'You have requested a barangay ID successfully!';
                    $_SESSION['success'] = 'success';
                } else {
                    $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
                    $_SESSION['success'] = 'danger';
                }
            }
        } else {
            $_SESSION['message'] = 'Nakab-ot na nimo ang maximum nga pangayo para sa Barangay ID. Palihog tan-awa ang status sa imong mga sertipikado o bisita sa Opisina sa Barangay alang sa klaripikasyon.';
            $_SESSION['success'] = 'info';
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }
    } else {
        $_SESSION['message'] = 'Hindi ka makapag-request ng Barangay ID nang walang pahintulot ng opisyal ng Barangay Los Amigos. Mangyaring magtungo sa kanilang opisina para sa kanilang tulong.';
        $_SESSION['success'] = 'info';
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
} else {
    // Check resident status
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
        $_SESSION['message'] = 'Ang iyong account ay nasa hold status at hindi maaaring magpatuloy sa paghiling ng mga sertipikasyon. Mangyaring maghintay hanggang ma-aprubahan ng iyong lider sa purok ang iyong resident identification. Salamat!';
        $_SESSION['success'] = 'info';
        header("Location: ../resident_profiling.php");
        exit();
    }

    // Check match with resident data
    $matchCheckQuery = "SELECT COUNT(*) AS match_count FROM tblresident WHERE email = '$user_email' AND purok = '$purok'";
    $matchCheckResult = $conn->query($matchCheckQuery);
    $matchCheckData = $matchCheckResult->fetch_assoc();

    if ($matchCheckData['match_count'] === 0) {
        $_SESSION['message'] = 'Hindi pa lubos na narehistro ang iyong account. Mangyaring i-rehistro muna ang iyong account.';
        $_SESSION['success'] = 'danger';
        header("Location: ../resident_profiling.php");
        exit();
    }

    // Insert new request
    $insert_query = "INSERT INTO tblbrgy_id(`id_no`, `fullname`, `birthdate`, `purok`, `precintno`, `phone`, `contact_number`, `guardian`, `relationship`, `cert_name`, `requirement`, `requester`, `email`) 
                    VALUES ('$id', '$owner', '$bdate', '$purok', '$precint', '$phone', '$contact', '$guardian', '$rship', '$cert_name', '$req', '$fname', '$user_email')";
    $result_resident = $conn->query($insert_query);

    if ($result_resident === true) {
        $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`) 
                            VALUES ('$fname', '$cert_name', '$user_email', '$purok', '$req', 'on hold')";
        $result_requested = $conn->query($insert_requested);

        if ($result_requested === true) {
            $_SESSION['message'] = 'You have requested a barangay ID successfully!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Something went wrong while inserting into tblbrgy_id: ' . $conn->error;
        $_SESSION['success'] = 'danger';
    }
}

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

$conn->close();
?>
