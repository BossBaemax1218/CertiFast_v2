<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../server/server.php');

    $user = $_POST['username'];
    $active = $_POST['is_active'];
    $reason = $_POST['reason'];
    $message = $_POST['message'];

    try {
        $conn->begin_transaction();

        $updateUserResidentSQL = "UPDATE tbl_user_admin SET is_active = ?, reason = ?, message = ? WHERE username = ?";
        $stmt = $conn->prepare($updateUserResidentSQL);
        if (!$stmt) {
            throw new Exception("Database Error: " . $conn->error);
        }
        $stmt->bind_param('ssss', $active, $reason, $message, $user);
        if (!$stmt->execute()) {
            throw new Exception("Update failed: " . $stmt->error);
        }
        $stmt->close();

        $conn->commit();

        $_SESSION['message'] = 'You successfully submitted a request.';
        $_SESSION['success'] = 'success';

        $conn->close();

        header('Location: ../users.php');
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['message'] = 'Error: ' . $e->getMessage();
        $_SESSION['success'] = 'danger';
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}
?>
