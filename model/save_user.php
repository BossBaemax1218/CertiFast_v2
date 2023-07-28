<?php 
    include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    $fullname       = $conn->real_escape_string($_POST['fullname']);
    $user       = $conn->real_escape_string($_POST['username']);
    $pass       = $conn->real_escape_string($_POST['pass']);
    $usertype   = $conn->real_escape_string($_POST['user_type']);
    $profile    = $conn->real_escape_string($_POST['profileimg']);
    $profile2   = $_FILES['img']['name'];
    $newName = date('dmYHis').str_replace(" ", "", $profile2);
    $target = "../assets/uploads/avatar/".basename($newName);

    if(!empty($user) && !empty($pass) && !empty($usertype)){
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        $query = "SELECT * FROM tbl_user_admin WHERE username='$user'";
        $res = $conn->query($query);

        if($res->num_rows){
            $_SESSION['message'] = 'Please enter a unique username!';
            $_SESSION['success'] = 'danger';
        }else{
            if(!empty($profile) && !empty($profile2)){
                $insert  = "INSERT INTO tbl_user_admin (`fullname`,`username`, `password`, user_type, avatar) VALUES ('$fullname','$user', '$hashedPassword', '$usertype','$profile')";
                $result  = $conn->query($insert);
    
                if($result === true){
                    $_SESSION['message'] = 'User added!';
                    $_SESSION['success'] = 'success';
    
                }else{
                    $_SESSION['message'] = 'Something went wrong!';
                    $_SESSION['success'] = 'danger';
                }
            }else if(!empty($profile) && empty($profile2)){
                $insert  = "INSERT INTO tbl_user_admin (`fullname`,`username`, `password`, user_type, avatar) VALUES ('$fullname','$user', '$hashedPassword', '$usertype','$profile')";
                $result  = $conn->query($insert);
    
                if($result === true){
                    $_SESSION['message'] = 'User added!';
                    $_SESSION['success'] = 'success';
    
                }else{
                    $_SESSION['message'] = 'Something went wrong!';
                    $_SESSION['success'] = 'danger';
                }
            }else if(empty($profile) && !empty($profile2)){
                $insert  = "INSERT INTO tbl_user_admin (`fullname`,`username`, `password`, user_type, avatar) VALUES ('$fullname','$user', '$hashedPassword', '$usertype','$newName')";
                $result  = $conn->query($insert);

                move_uploaded_file($_FILES['img']['tmp_name'], $target);

                if($result === true){
                    $_SESSION['message'] = 'User added!';
                    $_SESSION['success'] = 'success';
    
                }else{
                    $_SESSION['message'] = 'Something went wrong!';
                    $_SESSION['success'] = 'danger';
                }
            }else{
                $insert  = "INSERT INTO tbl_user_admin (`fullname`,`username`, `password`, user_type) VALUES ('$fullname','$user', '$hashedPassword', '$usertype')";
                $result  = $conn->query($insert);
                
                if($result === true){
                    $_SESSION['message'] = 'User added!';
                    $_SESSION['success'] = 'success';
    
                }else{
                    $_SESSION['message'] = 'Something went wrong!';
                    $_SESSION['success'] = 'danger';
                }
            }
        }
        
    }else{
        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../users.php");

    $conn->close();
?>
