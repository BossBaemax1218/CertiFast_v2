<?php
include '../server/server.php';

if (isset($_POST['password']) && isset($_POST['email']) && isset($_POST['selectedAction'])) {
    $password = $_POST['password'];
    $email = $_POST['email'];
    $selectedAction = $_POST['selectedAction'];
    
    if (empty($password)) {
        $_SESSION['password_error'] = "Password cannot be empty.";
    }

    // Password complexity validation
    $complexRegex = '/^(?=.*[A-Z])(?=.*[0-9\W]).+$/';
    if (!preg_match($complexRegex, $password)) {
        $_SESSION['password_error'] = "Password must contain at least one capital letter, one symbol or number.";
    }

    $hashedPassword = md5($password);

    $sql = "SELECT * FROM tbl_user_resident WHERE email = '$email' AND password = '$hashedPassword'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        if ($selectedAction === "deactivate") {
            $updateSql = "UPDATE tbl_user_resident SET status = 'inactive' WHERE email = '$email'";
            mysqli_query($connection, $updateSql);
        } elseif ($selectedAction === "delete") {
            $deleteSql = "DELETE FROM tbl_user_resident WHERE email = '$email'";
            mysqli_query($connection, $deleteSql);
        }
        // Redirect back to previous page with success message
        $_SESSION['success_message'] = "Action completed successfully.";
        // Redirect back to previous page with error message
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
        exit();

    } else {
        $_SESSION['password_error'] = "Invalid password.";
    }
} else {
    $_SESSION['password_error'] = "Missing data.";
}
?>

?>
