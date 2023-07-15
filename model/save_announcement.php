<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

	$name 	    = $conn->real_escape_string($_POST['username']);
	$subject 	= $conn->real_escape_string($_POST['subject']);
    $message 	= $conn->real_escape_string($_POST['message']);
    $date 	= $conn->real_escape_string($_POST['date']);

    if(!empty($name) && !empty($subject) && !empty($message)){

        $insert  = "INSERT INTO tbl_announcement (`username`, `subject`, `message`,`date_posted`) VALUES ('$name', '$subject', '$message','$date')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Announcement has been sent!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

	$conn->close();