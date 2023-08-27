<?php 
	include '../server/db_connection.php';

	if(!isset($_SESSION['fullname'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	$citizen 	= $conn->real_escape_string($_POST['citizenship']);
	$fname 		= $conn->real_escape_string($_POST['fname']);
	$mname 		= $conn->real_escape_string($_POST['mname']);
    $lname 		= $conn->real_escape_string($_POST['lname']);
	$address 	= $conn->real_escape_string($_POST['address']);
    $bplace 	= $conn->real_escape_string($_POST['bplace']);
	$bdate 		= $conn->real_escape_string($_POST['bdate']);
    $age 		= $conn->real_escape_string($_POST['age']);
    $cstatus 	= $conn->real_escape_string($_POST['cstatus']);
	$gender 	= $conn->real_escape_string($_POST['gender']);
    $purok 		= $conn->real_escape_string($_POST['purok']);
	$vstatus 	= $conn->real_escape_string($_POST['vstatus']);
    $email 		= $conn->real_escape_string($_POST['email']);
    $taxno	    = $conn->real_escape_string($_POST['taxno']);
	$number 	= $conn->real_escape_string($_POST['number']);
	$occupation = $conn->real_escape_string($_POST['occupation']);
	$req 		= $conn->real_escape_string($_POST['requester']);
	$profile 	= $conn->real_escape_string($_POST['profileimg']);
	$profile2 	= $_FILES['img']['name'];

	$checkQuery = "SELECT COUNT(*) as count FROM tblresident WHERE email = '$email' AND requester = '$req'";
	$checkResult = $conn->query($checkQuery);
	$checkData = $checkResult->fetch_assoc();

	if ($checkData['count'] > 0) {
		$_SESSION['message'] = 'You can no longer register another users information. Only one resident is allowed per one account.';
		$_SESSION['success'] = 'danger';
		header("Location: ../resident_profiling.php");
		exit();
	}


	$newName = date('dmYHis').str_replace(" ", "", $profile2);

  	$target = "../assets/uploads/resident_profile/".basename($newName);

	if(!empty($fname)){

		if(!empty($profile) && !empty($profile2)){

			$query = "INSERT INTO tblresident (`national_id`, citizenship, `picture`, `firstname`, `middlename`, `lastname`, `address`, `birthplace`, `birthdate`, age, `civilstatus`, `gender`, `purok`, `voterstatus`, `taxno`, `phone`, `email`, `occupation`, `residency_status`,`requester`) 
						VALUES ('$national_id','$citizen','$profile','$fname','$mname','$lname','$address','$bplace','$bdate',$age,'$cstatus','$gender','$purok','$vstatus','$taxno','$number','$email','$occupation','on hold', '$req')";

			if($conn->query($query) === true){

				if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){
					$_SESSION['message'] = 'Your personal information has been saved be aware that if your status is in ON HOLD, please wait for your Purok Leader to approved your information!';
					$_SESSION['success'] = 'success';
				} else {
					$_SESSION['message'] = 'Failed to upload the profile image.';
					$_SESSION['success'] = 'danger';
				}
			}
		} else if(!empty($profile) && empty($profile2)){

			$query = "INSERT INTO tblresident (`national_id`, citizenship, `picture`, `firstname`, `middlename`, `lastname`, `address`, `birthplace`, `birthdate`, age, `civilstatus`, `gender`, `purok`, `voterstatus`, `taxno`, `phone`, `email`,`occupation`, `residency_status`,`requester`) 
						VALUES ('$national_id','$citizen','$profile','$fname','$mname','$lname','$address','$bplace','$bdate',$age,'$cstatus','$gender','$purok','$vstatus','$taxno','$number','$email','$occupation','on hold','$req')";

			if($conn->query($query) === true){

				$_SESSION['message'] = 'Your personal information has been saved be aware that if your status is in ON HOLD, please wait for your Purok Leader to approved your information!';
				$_SESSION['success'] = 'success';
			}

		} else if(empty($profile) && !empty($profile2)){

			$query = "INSERT INTO tblresident (`national_id`, citizenship, `picture`, `firstname`, `middlename`, `lastname`, `address`, `birthplace`, `birthdate`, age, `civilstatus`, `gender`, `purok`, `voterstatus`, `taxno`, `phone`, `email`, `occupation`, `residency_status`,`requester`) 
						VALUES ('$national_id','$citizen','$newName','$fname','$mname','$lname','$address','$bplace','$bdate',$age,'$cstatus','$gender','$purok','$vstatus','$taxno','$number','$email','$occupation','on hold', '$req')";

			if($conn->query($query) === true){

				if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){
					$_SESSION['message'] = 'Your personal information has been saved be aware that if your status is in ON HOLD, please wait for your Purok Leader to approved your information!';
					$_SESSION['success'] = 'success';
				} else {
					$_SESSION['message'] = 'Failed to upload the profile image.';
					$_SESSION['success'] = 'danger';
				}
			}

		} else {
			$query = "INSERT INTO tblresident (`national_id`, citizenship, `picture`,`firstname`, `middlename`, `lastname`, `address`, `birthplace`, `birthdate`, age, `civilstatus`, `gender`, `purok`, `voterstatus`, `taxno`, `phone`, `email`, `occupation`, `residency_status`,`requester`) 
						VALUES ('$national_id','$citizen','person.png','$fname','$mname','$lname','$address','$bplace','$bdate',$age,'$cstatus','$gender','$purok','$vstatus','$taxno','$number','$email','$occupation','on hold','$req')";

			if($conn->query($query) === true){

				$_SESSION['message'] = 'Your personal information has been saved be aware that if your status is in ON HOLD, please wait for your Purok Leader to approved your information!';
				$_SESSION['success'] = 'success';
			}
		}

	} else {

		$_SESSION['message'] = 'Please complete the form!';
		$_SESSION['success'] = 'danger';
	}
	header("Location: ../resident_profiling.php");

	$conn->close();
?>
