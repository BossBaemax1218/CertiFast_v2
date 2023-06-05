<?php
session_start();
include '../server/server.php';

$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

// Validate username
$usernameRegex = "/^[a-zA-Z0-9_]{3,20}$/"; // Regular expression for username validation

if (!preg_match($usernameRegex, $username)) {
    $_SESSION['message'] = 'Error: Username must be between 3 and 20 characters long and can only contain letters, numbers, and underscores.';
    $_SESSION['success'] = 'danger';
    header('Location: ../login.php');
    exit();
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = 'Error: Invalid email format.';
    $_SESSION['success'] = 'danger';
    header('Location: ../login.php');
    exit();
}

// Validate password strength
if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[A-Z]+#", $password)) {
    $_SESSION['message'] = 'Error: Password must be at least 8 characters long, contain at least one uppercase letter, and at least one number.';
    $_SESSION['success'] = 'danger';
    header('Location: ../login.php');
    exit();
}

if (!empty($username) && !empty($email) && !empty($password)) {
    // Hash the password using SHA1
    $hashedPassword = sha1($password);

    $query = "INSERT INTO tbl_user_resident (`username`, `email`, `password`) VALUES ('$username', '$email', '$hashedPassword')";

    if ($conn->query($query)) {
        $_SESSION['message'] = 'You have successfully signed up!';
        $_SESSION['success'] = 'success';
        header('Location: ../login.php');
        exit();
    } else {
        $_SESSION['message'] = 'Error: Unable to sign up. Please try again later.';
        $_SESSION['success'] = 'danger';
        header('Location: ../login.php');
        exit();
    }
} else {
    $_SESSION['message'] = 'Error: Please fill in all the required fields.';
    $_SESSION['success'] = 'danger';
    header('Location: ../login.php');
    exit();
}

$conn->close();
?>
