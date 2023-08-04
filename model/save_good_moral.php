<?php 
    include('../server/server.php');

    if (!isset($_SESSION['fullname'])) {
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    $fullname  = $conn->real_escape_string($_POST['fullname']);
    $purok     = $conn->real_escape_string($_POST['purok']);
    $taxno     = $conn->real_escape_string($_POST['taxno']);
    $cert_name = $conn->real_escape_string($_POST['certificate_name']);
    $user_email = $conn->real_escape_string($_POST['email']);

    if (!empty($fullname) && !empty($purok) && !empty($taxno) && !empty($cert_name)) {
        list($firstname, $middlename, $lastname) = explode(' ', $fullname, 3);

        $update_query = "UPDATE tblresident SET `purok` = '$purok', `taxno` = '$taxno', `email` = '$user_email', `certificate_name` = '$cert_name' WHERE `firstname` = '$firstname' AND `middlename` = '$middlename' AND `lastname` = '$lastname'";
        $result_resident = $conn->query($update_query);

        if ($result_resident === true) {
            $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`,`status`) VALUES ('$fullname', '$cert_name','$user_email', '$purok','on hold')";
            $result_requested = $conn->query($insert_requested);

            if ($result_requested === true) {
                $_SESSION['message'] = 'You have requested a certificate of good moral has been sent!';
                $_SESSION['success'] = 'success';
            } else {
                $_SESSION['message'] = 'Something went wrong!';
                $_SESSION['success'] = 'danger';
            }
        } else {
            $_SESSION['message'] = 'Something went wrong!';
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
