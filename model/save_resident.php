<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}

	$national_id 	= $conn->real_escape_string($_POST['national']);
	$citizen 		= $conn->real_escape_string($_POST['citizenship']);
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
    $remarks 	= $conn->real_escape_string($_POST['remarks']);
	$profile 	= $conn->real_escape_string($_POST['profileimg']); // base 64 image
	$profile2 	= $_FILES['img']['name'];

	// change profile2 name
	$newName = date('dmYHis').str_replace(" ", "", $profile2);

	  // image file directory
  	$target = "../assets/uploads/resident_profile/".basename($newName);
	$check = "SELECT id FROM tblresident WHERE national_id='$national_id'";
	$nat = $conn->query($check)->num_rows;	

	if($nat == 0){
		if(!empty($fname)){

			if(!empty($profile) && !empty($profile2)){

				$query = "INSERT INTO tblresident (`national_id`,citizenship,`picture`, `firstname`, `middlename`, `lastname`, `address`, `birthplace`, `birthdate`, age, `civilstatus`, `gender`, `purok`, `voterstatus`, `taxno`, `phone`, `email`, `occupation`, `remarks`) 
							VALUES ('$national_id','$citizen','$profile','$fname','$mname','$lname','$address','$bplace','$bdate',$age,'$cstatus','$gender','$purok','$vstatus','$taxno','$number','$email','$occupation','$remarks')";

				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been saved!';
					$_SESSION['success'] = 'success';
				}
			}else if(!empty($profile) && empty($profile2)){

				$query = "INSERT INTO tblresident (`national_id`, citizenship, `picture`, `firstname`, `middlename`, `lastname`, `address`, `birthplace`, `birthdate`, age, `civilstatus`, `gender`, `purok`, `voterstatus`, `taxno`, `phone`, `email`,`occupation`, `remarks`) 
							VALUES ('$national_id','$citizen','$profile','$fname','$mname','$lname','$address','$bplace','$bdate',$age,'$cstatus','$gender','$purok','$vstatus','$taxno','$number','$email','$occupation','$remarks')";

				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been saved!';
					$_SESSION['success'] = 'success';
				}

			}else if(empty($profile) && !empty($profile2)){

				$query = "INSERT INTO tblresident (`national_id`, citizenship, `picture`, `firstname`, `middlename`, `lastname`, `address`, `birthplace`, `birthdate`, age, `civilstatus`, `gender`, `purok`, `voterstatus`, `taxno`, `phone`, `email`, `occupation`, `remarks`) 
							VALUES ('$national_id','$citizen','$newName','$fname','$mname','$lname','$address','$bplace','$bdate',$age,'$cstatus','$gender','$purok','$vstatus','$taxno','$number','$email','$occupation','$remarks')";

				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been saved!';
					$_SESSION['success'] = 'success';

					if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){

						$_SESSION['message'] = 'Resident Information has been saved!';
						$_SESSION['success'] = 'success';
					}
				}

			}else{
				$query = "INSERT INTO tblresident (`national_id`, citizenship, `picture`,`firstname`, `middlename`, `lastname`, `address`, `birthplace`, `birthdate`, age, `civilstatus`, `gender`, `purok`, `voterstatus`, `taxno`, `phone`, `email`, `occupation`, `remarks`) 
							VALUES ('$national_id','$citizen','person.png','$fname','$mname','$lname','$address','$bplace','$bdate',$age,'$cstatus','$gender','$purok','$vstatus','$taxno','$number','$email','$occupation','$remarks')";

				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been saved!';
					$_SESSION['success'] = 'success';
				}
			}

		}else{

			$_SESSION['message'] = 'Please complete the form!';
			$_SESSION['success'] = 'danger';
		}
	}else{
		$_SESSION['message'] = 'National ID is already taken. Please enter a unique national ID!';
		$_SESSION['success'] = 'danger';
	}
     header("Location: ../resident.php");

	$conn->close();

