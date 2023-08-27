<?php
include '../server/server.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $selectSql = "SELECT * FROM tbl_purok_trash WHERE id = ?";
    $selectStmt = $conn->prepare($selectSql);
    $selectStmt->bind_param("i", $id);
    $selectStmt->execute();
    $residentData = $selectStmt->get_result()->fetch_assoc();

    $insertSql = "INSERT INTO tblpurok_records (`national_id`,`citizenship`, `firstname`, `middlename`, `lastname`, `address`, `birthplace`, `birthdate`, `age`, `civilstatus`, `gender`, `purok`, `voterstatus`, `taxno`, `phone`, `email`, `occupation`, `resident_type`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("ssssssssssssssssss", 
        $residentData['national_id'], 
        $residentData['citizenship'], 
        $residentData['firstname'], 
        $residentData['middlename'], 
        $residentData['lastname'], 
        $residentData['address'],
        $residentData['birthplace'], 
        $residentData['birthdate'], 
        $residentData['age'], 
        $residentData['civilstatus'], 
        $residentData['gender'], 
        $residentData['purok'], 
        $residentData['voterstatus'], 
        $residentData['taxno'], 
        $residentData['phone'], 
        $residentData['email'], 
        $residentData['occupation'],
        $residentData['resident_type']);
    $insertStmt->execute();

    $deleteSql = "DELETE FROM tbl_purok_trash WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $id);
    $deleteStmt->execute();

    $_SESSION['message'] = "Resident restored successfully.";
    $_SESSION['success'] = "success";

    header("Location: ../archive_purok_records.php");
    exit;
}
?>
