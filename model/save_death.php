<?php 
session_start();
include('../server/server.php');

if (!isset($_SESSION['fullname'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fullname  = $conn->real_escape_string($_POST['dead_person']);
    $bdate      = $conn->real_escape_string($_POST['birthdate']);
    $age        = $conn->real_escape_string($_POST['age']);
    $purok     = $conn->real_escape_string($_POST['purok']);
    $ddate     = $conn->real_escape_string($_POST['death_date']);
    $cname      = $conn->real_escape_string($_POST['parents']);
    $rship      = $conn->real_escape_string($_POST['relationship']);
    $cert_name  = $conn->real_escape_string($_POST['certificate_name']);
    $fname      = $conn->real_escape_string($_POST['fullname']);
    $user_email = $conn->real_escape_string($_POST['email']);

    if (!empty($fullname) && !empty($bdate) && !empty($age) && !empty($purok) && !empty($ddate) && !empty($cname) && !empty($rship)) {
        list($firstname, $middlename, $lastname) = explode(' ', $fname, 3);

        $update_query = "UPDATE tblresident SET `dead_person` = '$fullname',`purpose` = '$bdate', `age` = '$age', `purok` = '$purok', `death_date` = '$ddate', `parents` = '$cname', `relationship` = '$rship', `certificate_name` = '$cert_name' WHERE `firstname` = '$firstname' AND `middlename` = '$middlename' AND `lastname` = '$lastname'";
        $result_resident = $conn->query($update_query);

        if ($result_resident) {
            $insert_requested = "INSERT INTO tblresident_requested (`resident_name`, `certificate_name`, `email`, `purok`, `status`) VALUES ('$fname', '$cert_name', '$user_email', '$purok', 'on hold')";
            $result_requested = $conn->query($insert_requested);

            if ($result_requested) {
                $_SESSION['message'] = 'You have requested a certificate of death that has been sent!';
                $_SESSION['success'] = 'success';
            } else {
                $_SESSION['message'] = 'Something went wrong while inserting into tblresident_requested!';
                $_SESSION['success'] = 'danger';
            }
        } else {
            $_SESSION['message'] = 'Something went wrong while updating tblresident!';
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }
} else {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}
$conn->close();
header("Location: " . $_SERVER["HTTP_REFERER"]);
exit();
?>
