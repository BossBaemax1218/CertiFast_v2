<?php 
include('../server/server.php');

if (!isset($_SESSION['fullname'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$fam1      = $conn->real_escape_string($_POST['fam_1']);
$fam2      = $conn->real_escape_string($_POST['fam_2']);
$fam3      = $conn->real_escape_string($_POST['fam_3']);
$fam4      = $conn->real_escape_string($_POST['fam_4']);
$fam5      = $conn->real_escape_string($_POST['fam_5']);
$tct      = $conn->real_escape_string($_POST['tctno']);
$req        = $conn->real_escape_string($_POST['requirements']);
$cert_name  = $conn->real_escape_string($_POST['certificate_name']);
$user_email = $conn->real_escape_string($_POST['email']);
$fullname      = $conn->real_escape_string($_POST['fullname']);

if (!empty($fam1) && !empty($fam2) &&!empty($fam3) &&!empty($fam4) &&!empty($fam5) && !empty($tct) && !empty($req)) {

    $insert_query = "INSERT INTO tblfamily_tax(`fam_1`,`fam_2`, `fam_3`, `fam_4`, `fam_5`,`tctno`,`cert_name`, `requirements`, `fullname`,`email`) VALUES ('$fam1','$fam2','$fam3','$fam4','$fam5','$tct','$cert_name','$req','$fullname', '$user_email')";
    $result_resident = $conn->query($insert_query);

    if ($result_resident === true) {
        $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `status`) VALUES ('$fullname', '$cert_name','$user_email', '$purok', 'on hold')";
        $result_requested = $conn->query($insert_requested);

        if ($result_requested === true) {
            $_SESSION['message'] = 'You have requested a certificate of family estate tax has been sent!';
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
    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

$conn->close();
?>
