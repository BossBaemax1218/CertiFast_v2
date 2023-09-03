<?php
include '../server/server.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $selectPermitSql = "SELECT * FROM tbl_trash_permit WHERE id = ?";
    $selectPermitStmt = $conn->prepare($selectPermitSql);
    $selectPermitStmt->bind_param("i", $id);
    $selectPermitStmt->execute();
    $permitData = $selectPermitStmt->get_result()->fetch_assoc();

    $insertPermitTrashSql = "INSERT INTO tblpermit (`id`, `status`, `permit_number`, `business_name`, `owner1`, `email`, `address`, `location`, `community_tax`, `issued_on`, `issued_at`, `validation`, `cert_name`, `requester`, `requirement`, `req_email`) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insertPermitTrashStmt = $conn->prepare($insertPermitTrashSql);
    $insertPermitTrashStmt->bind_param("isssssssssssssss",  
        $permitData['id'], 
        $permitData['status'],
        $permitData['permit_number'],
        $permitData['business_name'],
        $permitData['owner1'],
        $permitData['email'],
        $permitData['address'],
        $permitData['location'],
        $permitData['community_tax'],
        $permitData['issued_on'],
        $permitData['issued_at'],
        $permitData['validation'],
        $permitData['cert_name'],
        $permitData['requester'],
        $permitData['requirement'],
        $permitData['req_email']
    );
    $insertPermitTrashStmt->execute();

    $deletePermitSql = "DELETE FROM tbl_trash_permit WHERE id = ?";
    $deletePermitStmt = $conn->prepare($deletePermitSql);
    $deletePermitStmt->bind_param("i", $id);
    $deletePermitStmt->execute();

    $_SESSION['message'] = "Permit records have been restored successfully.";
    $_SESSION['success'] = "success";

    header("Location: ../trash_permit_files.php");
    exit;
}
?>
