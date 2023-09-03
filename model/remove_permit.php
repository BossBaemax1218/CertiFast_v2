<?php 
	include '../server/server.php';

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	
		$deleteSql = "DELETE FROM tbl_trash_permit WHERE id = ?";
		$deleteStmt = $conn->prepare($deleteSql);
		$deleteStmt->bind_param("i", $id);
		$deleteStmt->execute();
	
		$_SESSION['message'] = "Permit record has been permanently removed successfully.";
		$_SESSION['success'] = "success";
	
		header("Location: ../trash_permit_files.php");
		exit;
	}

