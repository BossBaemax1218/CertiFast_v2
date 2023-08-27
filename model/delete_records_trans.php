<?php
include '../server/server.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $deleteSql = "DELETE FROM tbl_trash_trans WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $id);
    $deleteStmt->execute();

    $_SESSION['message'] = "Resident records has been removed successfully.";
    $_SESSION['success'] = "success";

    header("Location: ../trash_trans_files.php");
    exit;
}
?>
