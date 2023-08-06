<?php
include '../server/server.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && ctype_digit($_POST['id'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM tblresident_requested WHERE cert_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Resident request has been removed!';
        $_SESSION['success'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['success'] = 'danger';
    }

    $stmt->close();
} else {
    $_SESSION['message'] = 'Invalid request!';
    $_SESSION['success'] = 'danger';
}

$conn->close();
header("Location: ../certificates_reports.php");
exit;
?>
