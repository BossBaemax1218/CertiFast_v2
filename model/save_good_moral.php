<?php 
include('../server/server.php');

if (!isset($_SESSION['fullname'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$fullname   = $conn->real_escape_string($_POST['fullname']);
$purok      = $conn->real_escape_string($_POST['purok']);
$tax        = $conn->real_escape_string($_POST['taxno']);
$cert_name  = $conn->real_escape_string($_POST['certificate_name']);
$fname = $conn->real_escape_string($_POST['fname']);
$user_email = $conn->real_escape_string($_POST['email']);

$checkQuery = "SELECT COUNT(*) as count FROM tblgood_moral WHERE fullname = '$fullname'";
$checkResult = $conn->query($checkQuery);
$checkData = $checkResult->fetch_assoc();

if ($checkData['count'] > 0) {
    $_SESSION['message'] = 'Please avoid requesting more when you have a pending request for the same certification. If you need clarification, please go to your <strong>History Certificates Status</strong> or just visit the <strong>Barangay Office</strong>. Thank you!';
    $_SESSION['success'] = 'danger';
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

if (!empty($fullname) && !empty($purok) && !empty($tax)) {

    $insert_query = "INSERT INTO tblgood_moral(`fullname`,`purok`, `taxno`, `cert_name`, `requester`,`email`) VALUES ('$fullname', '$purok', '$tax', '$cert_name', '$fname', '$user_email')";
    $result_resident = $conn->query($insert_query);

    if ($result_resident === true) {
        $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `requirement`, `status`) VALUES ('$fname', '$cert_name','$user_email', '$purok', '$tax', 'on hold')";
        $result_requested = $conn->query($insert_requested);

        if ($result_requested === true) {
            $_SESSION['message'] = 'You have requested a certificate of good moral has been sent!';
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
    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

$conn->close();
?>
