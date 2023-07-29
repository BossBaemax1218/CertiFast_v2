<?php
include 'server/server.php';
$username = $_SESSION["username"];
$sql = "SELECT 
            SUM(CASE WHEN r.residency_status = 'on hold' THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN r.residency_status = 'approved' THEN 1 ELSE 0 END) as approved,
            SUM(CASE WHEN r.residency_status = 'rejected' THEN 1 ELSE 0 END) as rejected
        FROM tblresident AS r 
        JOIN tbl_user_admin AS a ON r.purok = a.purok 
        WHERE a.username = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$pendingCount = $row['pending'];
$approvedCount = $row['approved'];
$rejectedCount = $row['rejected'];

$stmt->close();
$conn->close();

$revenue = array(
    'pending' => $pendingCount,
    'approved' => $approvedCount,
    'rejected' => $rejectedCount
);

?>
