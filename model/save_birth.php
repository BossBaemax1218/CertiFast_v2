<?php 
include('../server/server.php');

if (!isset($_SESSION['fullname'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$fullname      = $conn->real_escape_string($_POST['fullname']);
$age      = $conn->real_escape_string($_POST['age']);
$bdate      = $conn->real_escape_string($_POST['bdate']);
$purok      = $conn->real_escape_string($_POST['purok']);
$gender     = $conn->real_escape_string($_POST['gender']);
$mother      = $conn->real_escape_string($_POST['mother']);
$father      = $conn->real_escape_string($_POST['father']);
$req        = $conn->real_escape_string($_POST['requirement']);
$cert_name  = $conn->real_escape_string($_POST['certificate_name']);
$user_email = $conn->real_escape_string($_POST['email']);
$fname      = $conn->real_escape_string($_POST['fname']);

if (!empty($fullname) && !empty($age) &&!empty($bdate) &&!empty($purok) &&!empty($gender) && !empty($mother) && !empty($father) && !empty($req)) {

    $insert_query = "INSERT INTO tblbirthcert(`fullname`,`age`, `bdate`,`purok` ,`gender`,`mother`,`father`,`cert_name`, `requirement`, `requester`,`email`) 
                                 VALUES ('$fullname','$age','$bdate','$purok','$gender','$mother','$father','$cert_name','$req','$fname', '$user_email')";
    $result_resident = $conn->query($insert_query);

    if ($result_resident === true) {
        $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `status`) VALUES ('$fname', '$cert_name','$user_email', '$purok', 'on hold')";
        $result_requested = $conn->query($insert_requested);

        if ($result_requested === true) {
            $_SESSION['message'] = 'You have requested a certificate of birth has been sent!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested: ' . $conn->error;
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Something went wrong while inserting into tblbirthcert: ' . $conn->error;
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
