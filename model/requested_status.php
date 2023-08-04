<?php
include 'server/db_connection.php';

$username = $_SESSION["user_email"];
$sql = "SELECT 
            SUM(CASE WHEN r.status = 'on hold' THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN r.status = 'approved' THEN 1 ELSE 0 END) as approved,
            SUM(CASE WHEN r.status = 'rejected' THEN 1 ELSE 0 END) as rejected
			FROM tblresident_requested AS r 
			JOIN tbl_user_resident AS a ON r.email = a.user_email 
			WHERE a.user_email = ?";

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
