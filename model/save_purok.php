<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

	$purok 	= $conn->real_escape_string($_POST['purok']);
    $purok_leader 	= $conn->real_escape_string($_POST['purok_leader']);
    $contact_number	    = $conn->real_escape_string($_POST['contact_number']);
	$total_residents	= $conn->real_escape_string($_POST['total_residents']);
    $total_households	= $conn->real_escape_string($_POST['total_households']);

    if(!empty($purok) && !empty($total_residents) && !empty($total_households && !empty($purok_leader) && !empty($contact_number))){

        $insert  = "INSERT INTO tblpurok (`purok`, `total_residents`,`total_households`,`purok_leader`,`contact_number`) VALUES ('$purok', '$total_residents','$total_households', '$purok_leader', '$contact_number')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Purok added!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../purok.php");

	$conn->close();