<?php 
    include '../server/server.php';

    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    if ($username != '' && $password != '') {
        // Check if the user is a resident
        $residentQuery = "SELECT * FROM tbl_user_resident WHERE username = '$username' AND password = SHA1('$password')";
        $residentResult = $conn->query($residentQuery);

        // Check if the user is an admin or staff
        $adminStaffQuery = "SELECT * FROM tbl_users WHERE username = '$username' AND password = SHA1('$password')";
        $adminStaffResult = $conn->query($adminStaffQuery);

        if ($residentResult->num_rows) {
            $row = $residentResult->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = 'resident';
            $_SESSION['avatar'] = $row['avatar'];

            $_SESSION['message'] = 'You have successfully logged in as a resident!';
            $_SESSION['success'] = 'success';

            header('location: ../dashboard.php');
            exit();
        } elseif ($adminStaffResult->num_rows) {
            $row = $adminStaffResult->fetch_assoc();
            $role = $row['user_type'];

            if ($role == 'admin') {
                $_SESSION['message'] = 'You have successfully logged in as an admin!';
                $_SESSION['success'] = 'success';
            } elseif ($role == 'staff') {
                $_SESSION['message'] = 'You have successfully logged in as a staff!';
                $_SESSION['success'] = 'success';
            }

            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $role;
            $_SESSION['avatar'] = $row['avatar'];

            header('location: ../dashboard.php');
            exit();
        } else {
            $_SESSION['message'] = 'Username or password is incorrect!';
            $_SESSION['success'] = 'danger';
            header('location: ../login.php');
            exit();
        }
    } else {
        $_SESSION['message'] = 'Username or password is empty!';
        $_SESSION['success'] = 'danger';
        header('location: ../login.php');
        exit();
    }

    $conn->close();
?>
