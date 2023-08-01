<?php 
	include('../server/server.php');

    if(!isset($_SESSION['fullname'])){
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

    if(!empty($business_name) && !empty($owner1) && !empty($address) && !empty($location) && !empty($applied)){

        $insert  = "INSERT INTO tblpermit (`business_name`, `owner1`, `email`, address, location, applied, status) VALUES ('$business_name', '$owner1','$email', '$address', '$location','$applied', 'on hold')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Business Permit added!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../business_permit.php");

	$conn->close();