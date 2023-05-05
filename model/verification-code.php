<?php
// start session
session_start();

// check if email is stored in session
if (!isset($_SESSION["reset_email"])) {
    // email not found, redirect to reset password page
    header("Location: resetpassword.php");
    exit();
}

// connect to database
$conn = mysqli_connect("localhost", "username", "password", "database_name");

// handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST["code"];
    $email = $_SESSION["reset_email"];

    // check if verification code matches
    $query = "SELECT * FROM users WHERE email = '$email' AND verification_code = $code";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        // verification code is invalid
        $code_error = "Verification code is invalid.";
    } else {
        // verification code is valid, redirect to reset password page with email and code
        $row = mysqli_fetch_assoc($result);
        $user_id = $row["id"];
        header("Location: resetpassword.php?email=$email&code=$code&user_id=$user_id");
        exit();
    }
}

mysqli_close($conn);
?>