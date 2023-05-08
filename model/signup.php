<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$fullname 	= $conn->real_escape_string($_POST['fullname']);
    $email 	= $conn->real_escape_string($_POST['email']);
	$password 	= $conn->real_escape_string($_POST['password']);

    if(!empty($fullname) && !empty($email) && !empty($password)){

        $insert  = "INSERT INTO tbl_user_resident (`fullname`,`email`, `password`) VALUES ('$fullname', '$email', '$password')";
        $result  = $conn->query($insert);
        

        if($result->num_rows){
			while ($row = $result->fetch_assoc()) {
				$_SESSION['id'] = $row['id'];
				$_SESSION['fullname'] = $row['fullname'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['password'] = $row['password'];
			}

			$_SESSION['message'] = 'You have successfull logged in to CertiFast - Barangay Los Amigos!';
			$_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
        
    }
    header("Location: ../dashboard.php");
    

	$conn->close();