<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

	$id 	= $conn->real_escape_string($_POST['id']);
    $profile 	= $conn->real_escape_string($_POST['profileimg']);
	$profile2 	= $_FILES['img']['name'];
    $newName = date('dmYHis').str_replace(" ", "", $profile2);
    $target = "../assets/uploads/avatar/".basename($newName);

    if(!empty($id)){
        $query = "SELECT * FROM tbl_user_admin WHERE id='$id'";
        $res = $conn->query($query);

        if($res->num_rows == 0){

            $_SESSION['message'] = 'User not found!';
            $_SESSION['success'] = 'danger';

            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }

        }else{
            if(!empty($profile) && !empty($profile2)){
                $insert  = "UPDATE tbl_user_admin SET avatar='$profile' WHERE id='$id'";
                $result  = $conn->query($insert);
                $_SESSION['avatar'] = $profile;
            }else if(!empty($profile) && empty($profile2)){
                $insert  = "UPDATE tbl_user_admin SET avatar='$profile' WHERE id='$id'";
                $result  = $conn->query($insert);
                $_SESSION['avatar'] = $profile;
            }else{
                $insert  = "UPDATE tbl_user_admin SET avatar='$newName' WHERE id='$id'";
                $result  = $conn->query($insert);
                move_uploaded_file($_FILES['img']['tmp_name'], $target);
                $_SESSION['avatar'] = $newName;
            }

            $_SESSION['message'] = "Profile has been updated! Please login again!";
            $_SESSION['success'] = 'success';
        }
        
    }

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
	$conn->close();
