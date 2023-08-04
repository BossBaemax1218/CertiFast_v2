<?php 
	include '../server/db_connection.php';

	if(!isset($_SESSION['fullname']) && $_SESSION['role']!='resident'){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
	$id 	= $conn->real_escape_string($_GET['cert_id']);

	if($id != ''){
		$query 		= "DELETE FROM tblresident_requested WHERE cert_id = '$id'";
		
		$result 	= $conn->query($query);
		
		if($result === true){
            $_SESSION['message'] = 'The certificate data has been removed!';
            $_SESSION['success'] = 'danger';
            
        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }
	}else{

		$_SESSION['message'] = 'Missing Barangay ID no.!';
		$_SESSION['success'] = 'danger';
	}

	header("Location: ../certificates_reports.php");
	$conn->close();

