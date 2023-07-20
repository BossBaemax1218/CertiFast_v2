<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$purok 	            = $conn->real_escape_string($_POST['purok']);
    $purok_leader	            = $conn->real_escape_string($_POST['purok_leader']);
	$total_residents 	= $conn->real_escape_string($_POST['total_residents']);
    $total_households 	= $conn->real_escape_string($_POST['total_households']);
    $id 	            = $conn->real_escape_string($_POST['id']);

    if(!empty($id)){

        $query 		= "UPDATE tblpurok SET `purok` = '$purok', `total_residents`='$total_residents',`total_households`='$total_households' ,`purok_leader`='$purok_leader' WHERE id=$id;";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'Purok has been updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'No purok ID found!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../purok.php");

	$conn->close();