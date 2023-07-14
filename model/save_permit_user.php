<?php 
	include('../server/server.php');

    if(!isset($_SESSION['fullname'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$name 	    = $conn->real_escape_string($_POST['name']);
	$owner1 	= $conn->real_escape_string($_POST['owner1']);
    $email 	    = $conn->real_escape_string($_POST['email']);
	$nature 	= $conn->real_escape_string($_POST['nature']);
    $applied 	= $conn->real_escape_string($_POST['applied']);

    if(!empty($name) && !empty($owner1) && !empty($nature) && !empty($applied)){

        $insert  = "INSERT INTO tblpermit (`name`, `owner1`, `email`, nature, applied) VALUES ('$name', '$owner1','$email', '$nature','$applied')";
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

    header("Location: ../resident_bpermit.php");

	$conn->close();