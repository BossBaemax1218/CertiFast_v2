<?php 
	include '../server/server.php';

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	
		$deleteSql = "DELETE FROM tbl_trash_support WHERE id = ?";
		$deleteStmt = $conn->prepare($deleteSql);
		$deleteStmt->bind_param("i", $id);
		$deleteStmt->execute();
	
		$_SESSION['message'] = "Support record has been permanently removed successfully.";
		$_SESSION['success'] = "success";
	
		header("Location: ../trash_support_files.php");
		exit;
	}
