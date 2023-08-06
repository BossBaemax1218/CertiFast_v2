<?php 
include('../server/server.php');

if (!isset($_SESSION['fullname'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$husband   = $conn->real_escape_string($_POST['husband']);
$wife   = $conn->real_escape_string($_POST['wife']);
$h_age   = $conn->real_escape_string($_POST['wife_age']);
$purok      = $conn->real_escape_string($_POST['purok']);
$w_age        = $conn->real_escape_string($_POST['husband_age']);
$living_year   = $conn->real_escape_string($_POST['living_year']);
$req   = $conn->real_escape_string($_POST['requirements']);
$cert_name  = $conn->real_escape_string($_POST['certificate_name']);
$fname = $conn->real_escape_string($_POST['fname']);
$user_email = $conn->real_escape_string($_POST['email']);

if (!empty($husband) && !empty($wife) &&  !empty($h_age) &&  !empty($w_age) &&  !empty($purok) &&  !empty($living_year) &&  !empty($req)) {

    $insert_query = "INSERT INTO tbllive_in(`husband`, `wife`, `husband_age`, `wife_age`, `purok`, `living_year`, `requirements`, `cert_name`, `requester`,`email`) 
                                    VALUES ('$husband', '$wife', '$h_age', '$w_age','$purok', '$living_year','$req', '$cert_name','$fname',  '$user_email')";
    $result_resident = $conn->query($insert_query);

    if ($result_resident === true) {
        $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `status`) VALUES ('$fname', '$cert_name','$user_email', '$purok', 'on hold')";
        $result_requested = $conn->query($insert_requested);

        if ($result_requested === true) {
            $_SESSION['message'] = 'You have requested a certificate of live in has been sent!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Something went wrong while inserting into tbllive_in: ' . $conn->error;
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
