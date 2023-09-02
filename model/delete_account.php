<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../server/db_connection.php');

    $email = $_POST['email'];
    $reason = $_POST['reason'];
    $message = $_POST['message'];

    try {
        $sql = "UPDATE tbl_user_resident SET is_active = 'inactive', reason = ?, message = ? WHERE user_email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $reason, $message, $email);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        session_destroy();

        // Set a success message
        $_SESSION['message'] = 'You successfully submitted a deletion request. Please allow us to 2-3 days for a confirmation. Also, you can go to the Barangay Los Amigos Office for this matter.';
        $_SESSION['success'] = 'success';

        header('Location: ../login.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['message'] = 'Error: ' . $e->getMessage();
        $_SESSION['success'] = 'danger';
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}
?>
