<?php
session_start();
include '../server/server.php';

$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

// Validate regular expression for username
$usernameRegex = "/^[a-zA-Z0-9_]{3,20}$/";

if (!preg_match($usernameRegex, $username)) {
    $_SESSION['message'] = 'Invalid username must contain unique characters, uppercase, lowercase, and numbers.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';
    
    header('Location: ../login.php');
    exit();
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = 'Invalid email format.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';
    
    header('Location: ../login.php');
    exit();
}

// Validate password strength
if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[A-Z]+#", $password)) {
    $_SESSION['message'] = 'Invalid password must contain unique characters, uppercase, lowercase, and numbers.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';

    header('Location: ../login.php');
    exit();
}

// Check if the username already exists in tbl_user_resident
$checkQueryResident = "SELECT * FROM tbl_user_resident WHERE username = '$username'";
$resultResident = $conn->query($checkQueryResident);

if ($resultResident->num_rows > 0) {
    $_SESSION['message'] = 'Username already exists, choose a different one.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';

    header('Location: ../login.php');
    exit();
}

// Check if the username already exists in tbl_user_admin
$checkQueryUsers = "SELECT * FROM tbl_user_admin WHERE username = '$username'";
$resultUsers = $conn->query($checkQueryUsers);

if ($resultUsers->num_rows > 0) {
    $_SESSION['message'] = 'Username already exists, choose a different one.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';

    header('Location: ../login.php');
    exit();
}

// Register the user
if (!empty($username) && !empty($email) && !empty($password)) {
    // Hash the password using SHA1
    $hashedPassword = sha1($password);

    $query = "INSERT INTO tbl_user_resident (`username`, `email`, `password`) VALUES ('$username', '$email', '$hashedPassword')";

    if ($conn->query($query)) {
        $_SESSION['message'] = 'You have successfully signed up!';
        $_SESSION['success'] = 'success';
        $_SESSION['form'] = 'signup';

        header('Location: ../login.php');
        exit();
    } else {
        $_SESSION['message'] = 'Unable to sign up. Please try again later.';
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'signup';

        header('Location: ../login.php');
        exit();
    }
} else {
    $_SESSION['message'] = 'Please fill in all the required fields.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';

    header('Location: ../login.php');
    exit();
}

$conn->close();
?>
