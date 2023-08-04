<?php
session_start();
include '../server/server.php';

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}

if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'administrator' && $_SESSION['role'] !== 'staff')) {
    $_SESSION['message'] = 'You are not authorized to perform this action.';
    $_SESSION['success'] = 'danger';
    header("Location: ../list_certificates.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $conn->real_escape_string($_POST['cert_id']);
    $status = $conn->real_escape_string($_POST['status']);

    if (!empty($id) && !empty($status)) {
        $validStatuses = array('approved', 'rejected', 'on hold','claimed');
        if (in_array($status, $validStatuses)) {
            $query = "UPDATE tblresident_requested SET status=? WHERE cert_id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $status, $id);

            if ($stmt->execute()) {
                $_SESSION['message'] = 'Status has been updated!';
                $_SESSION['success'] = 'success';

                if ($status === 'rejected') {
                    header("Location: ../list_certificates.php");
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

header("Location: ../list_certificates.php");
exit();
?>
