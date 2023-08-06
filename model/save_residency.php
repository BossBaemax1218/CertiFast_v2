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
$user_email = $conn->real_escape_string($_POST['requester']);

if (!empty($fullname) && !empty($purok) && !empty($age) && !empty($res_years) && !empty($req)) {

    $insert_query = "INSERT INTO tblresidency(`fullname`,`cert_name`,`age`, `purok`, `resident_year`, `requirement`, `email`) VALUES ('$fullname', '$cert_name',  '$age', '$purok', '$res_years', '$req', '$user_email')";
    $result_resident = $conn->query($insert_query);

    if ($result_resident === true) {
        $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `status`) VALUES ('$fullname', '$cert_name','$user_email', '$purok', 'on hold')";
        $result_requested = $conn->query($insert_requested);

        if ($result_requested === true) {
            $_SESSION['message'] = 'You have requested a certificate of residency has been sent!';
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
    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

$conn->close();
?>
