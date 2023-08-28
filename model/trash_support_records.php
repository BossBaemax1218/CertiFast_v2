<?php
include '../server/server.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $selectSql = "SELECT * FROM tbl_support WHERE id = ?";
    $selectStmt = $conn->prepare($selectSql);
    $selectStmt->bind_param("i", $id);
    $selectStmt->execute();
    $paymentData = $selectStmt->get_result()->fetch_assoc();

    $insertSql = "INSERT INTO tbl_trash_support (`name`, `email`, `number`, `subject`, `message`, `user`) 
                  VALUES (?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("ssssss",  
        $paymentData['name'], 
        $paymentData['email'], 
        $paymentData['number'], 
        $paymentData['subject'], 
        $paymentData['message'],
        $paymentData['user']);
    $insertStmt->execute();

    $deleteSql = "DELETE FROM tbl_support WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $id);
    $deleteStmt->execute();

    $_SESSION['message'] = "Support record has been restored successfully.";
    $_SESSION['success'] = "success";

    header("Location: ../support.php");
    exit;
}
?>
