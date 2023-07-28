<?php
session_start();
include '../server/server.php';

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}

if ($_SESSION['role'] !== 'purok leader') {
    $_SESSION['message'] = 'You are not authorized to perform this action.';
    $_SESSION['success'] = 'danger';
    header("Location: ../purok_request.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $conn->real_escape_string($_POST['id']);
    $rstatus = $conn->real_escape_string($_POST['rstatus']);

    if (!empty($id) && !empty($rstatus)) {
        $validStatuses = array('approved', 'rejected', 'on hold');
        if (in_array($rstatus, $validStatuses)) {
            $query = "UPDATE tblresident SET residency_status=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $rstatus, $id);

            if ($stmt->execute()) {
                $_SESSION['message'] = 'Status has been updated!';
                $_SESSION['success'] = 'success';

                if ($rstatus === 'rejected') {
                    header("Location: ../purok_requested.php");
                    exit();
                }
            } else {
                $_SESSION['message'] = 'Failed to update Status.';
                $_SESSION['success'] = 'danger';
                echo $stmt->error; 
            }

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

header("Location: ../purok_request.php");
exit();
?>
