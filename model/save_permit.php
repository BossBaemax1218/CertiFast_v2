<?php 
    include('../server/server.php');

    if (!isset($_SESSION['fullname'])) {
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

	$business_name = $conn->real_escape_string($_POST['business_name']);
	$owner1 	= $conn->real_escape_string($_POST['owner1']);
    $email 	    = $conn->real_escape_string($_POST['email']);
	$address	= $conn->real_escape_string($_POST['address']);
    $location	= $conn->real_escape_string($_POST['location']);
    $applied 	= $conn->real_escape_string($_POST['applied']);
    $cert_name  = $conn->real_escape_string($_POST['certificate_name']);
    $fname = $conn->real_escape_string($_POST['fname']);
    $user_email = $conn->real_escape_string($_POST['req_email']);
    $req = $conn->real_escape_string($_POST['requirement']);

    if(!empty($business_name) && !empty($owner1) && !empty($address) && !empty($email) && !empty($location) && !empty($applied)){

        $insert  = "INSERT INTO tblpermit (`business_name`, `owner1`, `email`, address, location, applied, status, cert_name, requester, req_email, requirement) VALUES ('$business_name', '$owner1','$email', '$address', '$location','$applied', 'on hold','$cert_name','$fname','$req_email','$req')";
        $result  = $conn->query($insert);

        if ($result === true) {
            $insert_requested = "INSERT INTO tblresident_requested(`resident_name`, `certificate_name`, `email`, `purok`, `status`, requirement) VALUES ('$fname', '$cert_name','$user_email', '$address', 'on hold', '$req')";
            $result_requested = $conn->query($insert_requested);

            $_SESSION['message'] = 'You have requested a business permit has been sent!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../resident_request.php");
    $conn->close();
?>
