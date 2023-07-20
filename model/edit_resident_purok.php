<?php
session_start(); // Start the session if not already started
include '../server/server.php';

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}

// Check if the user is authorized to perform this action (You can modify this condition as per your requirements)
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = 'You are not authorized to perform this action.';
    $_SESSION['success'] = 'danger';
    header("Location: ../purok_request.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $conn->real_escape_string($_POST['id']);
    $rstatus = $conn->real_escape_string($_POST['rstatus']);

    if (!empty($id) && !empty($rstatus)) {
        // Validate $rstatus to make sure it contains valid values
        $validStatuses = array('approved', 'rejected', 'on hold'); // Add more valid statuses as needed
        if (in_array($rstatus, $validStatuses)) {
            $query = "UPDATE tblresident SET residency_status=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $rstatus, $id);

            if ($stmt->execute()) {
                $_SESSION['message'] = 'Status has been updated!';
                $_SESSION['success'] = 'success';
            } else {
                $_SESSION['message'] = 'Failed to update Status.';
                $_SESSION['success'] = 'danger';
                echo $stmt->error; // Output the error message for debugging purposes
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            $_SESSION['message'] = 'Invalid residency status.';
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Please provide the resident ID and residency status.';
        $_SESSION['success'] = 'danger';
    }
}

// Redirect to the appropriate page
header("Location: ../purok_request.php");
exit();
?>
