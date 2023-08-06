<?php 
include('../server/server.php');

if (!isset($_SESSION['fullname'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$id   = $conn->real_escape_string($_POST['id_no']);
$owner   = $conn->real_escape_string($_POST['fullname']);
$bdate   = $conn->real_escape_string($_POST['birthdate']);
$purok      = $conn->real_escape_string($_POST['purok']);
$precint        = $conn->real_escape_string($_POST['precintno']);
$phone   = $conn->real_escape_string($_POST['phone']);
$contact   = $conn->real_escape_string($_POST['contact_number']);
$guardian   = $conn->real_escape_string($_POST['guardian']);
$rship  = $conn->real_escape_string($_POST['relationship']);
$cert_name  = $conn->real_escape_string($_POST['certificate_name']);
$fname = $conn->real_escape_string($_POST['fname']);
$user_email = $conn->real_escape_string($_POST['email']);

if (!empty($id) && !empty($owner) &&  !empty($bdate) &&  !empty($purok) &&  !empty($precint) &&  !empty($phone) &&  !empty($contact) &&  !empty($guardian) &&  !empty($rship)) {

    $insert_query = "INSERT INTO tblbrgy_id(`id_no`, `fullname`, `birthdate`, `purok`, `precintno`, `phone`, `contact_number`,`guardian`,`relationship`, `cert_name`, `requester`,`email`) 
                                    VALUES ('$id', '$owner', '$bdate', '$purok','$precint', '$phone','$contact', '$guardian','$rship','$cert_name', '$fname',  '$user_email')";
    $result_resident = $conn->query($insert_query);

    if ($result_resident === true) {
        $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `status`) VALUES ('$fname', '$cert_name','$user_email', '$purok', 'on hold')";
        $result_requested = $conn->query($insert_requested);

        if ($result_requested === true) {
            $_SESSION['message'] = 'You have requested a barangay ID in has been sent!';
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
    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

$conn->close();
?>
