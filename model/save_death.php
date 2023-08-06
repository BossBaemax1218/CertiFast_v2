<?php 
include('../server/server.php');

if (!isset($_SESSION['fullname'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$dead_person      = $conn->real_escape_string($_POST['dead_person']);
$death_bdate      = $conn->real_escape_string($_POST['death_bdate']);
$age      = $conn->real_escape_string($_POST['age']);
$purok      = $conn->real_escape_string($_POST['purok']);
$death_date      = $conn->real_escape_string($_POST['death_date']);
$guardian      = $conn->real_escape_string($_POST['guardian']);
$rship      = $conn->real_escape_string($_POST['relationship']);
$cert_name  = $conn->real_escape_string($_POST['certificate_name']);
$user_email = $conn->real_escape_string($_POST['email']);
$fullname      = $conn->real_escape_string($_POST['fullname']);

if (!empty($dead_person) && !empty($death_bdate) &&!empty($age) &&!empty($purok) &&!empty($death_date) && !empty($guardian) && !empty($rship)) {

    $insert_query = "INSERT INTO tbldeath(`death_person`,`death_bdate`, `age`, `purok`, `death_date`,`guardian`,`relationship`, `cert_name`, `requester`,`email`) 
                                VALUES ('$dead_person','$death_bdate','$age','$purok','$death_date','$guardian','$rship', '$cert_name','$fullname', '$user_email')";
    $result_resident = $conn->query($insert_query);

    if ($result_resident === true) {
        $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `status`) VALUES ('$fullname', '$cert_name','$user_email', '$purok', 'on hold')";
        $result_requested = $conn->query($insert_requested);

        if ($result_requested === true) {
            $_SESSION['message'] = 'You have requested a certificate of death has been sent!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Something went wrong while inserting into tbldeath: ' . $conn->error;
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
