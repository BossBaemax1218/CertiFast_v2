<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../server/server.php');

    $email = $_POST['email'];
    $active = $_POST['is_active'];
    $reason = $_POST['reason'];
    $message = $_POST['message'];

    try {
        $sql = "UPDATE tbl_user_resident SET is_active = ?, reason = ?, message = ? WHERE user_email = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Database Error: " . $conn->error);
        }
        $stmt->bind_param('ssss', $active, $reason, $message, $email);
        if (!$stmt->execute()) {
            throw new Exception("Update failed: " . $stmt->error);
        }

        $_SESSION['message'] = 'You successfully submitted a deactivation request.';
        $_SESSION['success'] = 'success';

        $stmt->close();
        $conn->close();

        header('Location: ../user-resident.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['message'] = 'Error: ' . $e->getMessage();
        $_SESSION['success'] = 'danger';
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}
?>
