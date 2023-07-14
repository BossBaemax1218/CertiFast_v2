<?php 
    include '../server/server.php';
    
    $username   = $conn->real_escape_string($_POST['fullname']);
    $cur_pass   = $conn->real_escape_string($_POST['cur_pass']);
    $new_pass   = $conn->real_escape_string($_POST['new_pass']);
    $con_pass   = $conn->real_escape_string($_POST['con_pass']);

    if (!empty($username)) {
        if ($new_pass == $con_pass) {

            $check = "SELECT * FROM tbl_user_resident WHERE fullname='$username'";
            $res = $conn->query($check);

            if ($res->num_rows) {

                $user = $res->fetch_assoc();
                $stored_hash = $user['password'];

                $cur_pass_md5 = md5($cur_pass); // MD5 hash of the entered current password

                if ($cur_pass_md5 === $stored_hash) {

                    $new_hash = md5($new_pass);
                    $query = "UPDATE tbl_user_resident SET `password`='$new_hash' WHERE fullname='$username'";    
                    $result = $conn->query($query);

                    if ($result === true) {
                        $_SESSION['message'] = 'Password has been updated!';
                        $_SESSION['success'] = 'success';
                    } else {
                        $_SESSION['message'] = 'Something went wrong!';
                        $_SESSION['success'] = 'danger';
                    }
                } else {
                    $_SESSION['message'] = 'Current Password is incorrect!';
                    $_SESSION['success'] = 'danger';
                }
            } else {
                $_SESSION['message'] = 'No Username found!';
                $_SESSION['success'] = 'danger';
            }

        } else {
            $_SESSION['message'] = 'Password did not match!';
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'No Username found!';
        $_SESSION['success'] = 'danger';
    }

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    $conn->close();
?>
