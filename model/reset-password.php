<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('location: login.php');
    exit;
}

require_once "../server/server.php";

// Initialize variables
$new_password = $confirm_password = $code = "";
$new_password_err = $confirm_password_err = $code_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have at least 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate verification code
    if(empty(trim($_POST["code"]))){
        $code_err = "Please enter the verification code.";
    } else{
        $code = trim($_POST["code"]);
    }

    // Check input errors before updating the password
    if(empty($new_password_err) && empty($confirm_password_err) && empty($code_err)){

        // Prepare a SELECT statement to check if the verification code is valid
        $sql = "SELECT email FROM reset_password WHERE code = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_code);
            
            // Set parameters
            $param_code = $code;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store the result
                mysqli_stmt_store_result($stmt);
                
                // Check if the verification code exists and get the user email
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $email);
                    mysqli_stmt_fetch($stmt);

                    // Prepare an UPDATE statement to reset the user password
                    $sql = "UPDATE users SET password = ? WHERE email = ?";
                    
                    if($stmt = mysqli_prepare($link, $sql)){
                        // Hash the password
                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                        
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $param_email);
                        
                        // Set parameters
                        $param_email = $email;
                        
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            // Password updated successfully. Destroy the reset_password session and redirect to login page
                            unset($_SESSION["reset_password"]);
                            header("location: login.php");
                            exit();
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }

                        // Close statement
                        mysqli_stmt_close($stmt);
                    }

                } else{
                    // Verification code is invalid
                    $code_err = "The verification code is invalid.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

    } else {
        // Verify the verification code
        $stmt = $pdo->prepare("SELECT * FROM password_reset WHERE email=:email AND code=:code AND expires_at > NOW()");
        $stmt->execute(array(':email' => $email, ':code' => $verification_code));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // If the verification code is invalid or has expired, show an error message
        if (!$user) {
            $code_error = "Invalid or expired verification code.";
        } else {
            // Update the user's password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password=:password_hash WHERE email=:email");
            $stmt->execute(array(':password_hash' => $password_hash, ':email' => $email));
    
            // Delete the password reset request from the database
            $stmt = $pdo->prepare("DELETE FROM password_reset WHERE email=:email");
            $stmt->execute(array(':email' => $email));
    
            // Redirect the user to the login page with a success message
            header("Location: login.php?reset=success");
            exit();
        }
    }
}
    ?>
    
    