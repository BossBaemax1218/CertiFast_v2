<?php 
    include '../server/server.php';

    if (!isset($_SESSION['username'])) {
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
    $id = $conn->real_escape_string($_POST['id']);
    $rstatus = $conn->real_escape_string($_POST['rstatus']);

    if (!empty($id)) {
        $query = "UPDATE tblresident SET residency_status=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $rstatus, $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'Residency Status has been updated!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Failed to update Residency Status.';
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Please provide the resident ID!';
        $_SESSION['success'] = 'danger';
    }

    // Check for errors or exceptions during the execution of the query
    if ($stmt->error) {
        $_SESSION['message'] .= ' Error: ' . $stmt->error;
        $_SESSION['success'] = 'danger';
    }

    // Redirect to the appropriate page
    header("Location: ../purok_request.php");
    exit();
?>
