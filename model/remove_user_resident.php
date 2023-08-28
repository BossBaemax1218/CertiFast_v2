<?php 
	include '../server/server.php';

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	
		$deleteSql = "DELETE FROM tbl_user_resident WHERE id = ?";
		$deleteStmt = $conn->prepare($deleteSql);
		$deleteStmt->bind_param("i", $id);
		$deleteStmt->execute();
	
		$_SESSION['message'] = "User account has been permanently removed successfully.";
		$_SESSION['success'] = "success";
	
		header("Location: ../user-resident.php");
		exit;
	}
