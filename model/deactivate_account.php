<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../server/server.php');

    $email = $_POST['email'];
    $active = $_POST['is_active'];
    $reason = $_POST['reason'];
    $message = $_POST['message'];

    $residency_status = ($active === 'active') ? 'approved' : 'rejected';

    try {
        $conn->begin_transaction();

        $updateUserResidentSQL = "UPDATE tbl_user_resident SET is_active = ?, reason = ?, message = ? WHERE user_email = ?";
        $stmt = $conn->prepare($updateUserResidentSQL);
        if (!$stmt) {
            throw new Exception("Database Error: " . $conn->error);
        }
        $stmt->bind_param('ssss', $active, $reason, $message, $email);
        if (!$stmt->execute()) {
            throw new Exception("Update failed: " . $stmt->error);
        }
        $stmt->close();

        $updateResidentSQL = "UPDATE tblresident SET residency_status = ? WHERE email = ?";
        $stmt = $conn->prepare($updateResidentSQL);
        if (!$stmt) {
            throw new Exception("Database Error: " . $conn->error);
        }
        $stmt->bind_param('ss', $residency_status, $email);
        if (!$stmt->execute()) {
            throw new Exception("Update failed: " . $stmt->error);
        }
        $stmt->close();

        $conn->commit();

        $_SESSION['message'] = 'You successfully submitted a request.';
        $_SESSION['success'] = 'success';

        $conn->close();

        header('Location: ../user-resident.php');
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
