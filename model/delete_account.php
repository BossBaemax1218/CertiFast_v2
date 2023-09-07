<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../server/db_connection.php');

    $email = $_POST['email'];
    $reason = $_POST['reason'];
    $message = $_POST['message'];

    try {
        $conn->begin_transaction();

        $updateUserResidentSQL = "UPDATE tbl_user_resident SET is_active = 'inactive', reason = ?, message = ? WHERE user_email = ?";
        $stmt = $conn->prepare($updateUserResidentSQL);
        $stmt->bind_param('sss', $reason, $message, $email);
        $stmt->execute();
        $stmt->close();

        $updateResidentSQL = "UPDATE tblresident SET residency_status = 'rejected' WHERE email = ?";
        $stmt = $conn->prepare($updateResidentSQL);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->close();

        $conn->commit();

        session_destroy();

        $_SESSION['message'] = 'You successfully submitted a deletion request. Please allow us 2-3 days for confirmation. You can also visit the Barangay Los Amigos Office for further assistance.';
        $_SESSION['success'] = 'success';
        $_SESSION['form'] = 'login';

        header('Location: ../login.php');
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
