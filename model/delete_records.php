<?php
include '../server/server.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $deleteSql = "DELETE FROM tbl_purok_trash WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $id);
    $deleteStmt->execute();

    $_SESSION['message'] = "Resident records has been removed successfully.";
    $_SESSION['success'] = "success";

    header("Location: ../archive_purok_records.php");
    exit;
}
?>
