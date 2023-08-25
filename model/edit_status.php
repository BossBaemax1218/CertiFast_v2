<?php
include('../server/server.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selectedRows']) && isset($_POST['newStatus'])) {
        $selectedRows = explode(',', $_POST['selectedRows']);
        $newStatus = $_POST['newStatus'];

        $updateQuery = "UPDATE tblresident_requested SET status = ? WHERE req_cert_id IN (" . implode(',', $selectedRows) . ")";
        
        if ($conn->query($updateQuery) === TRUE) {
            $response = [
                'newStatus' => $newStatus,
                'newStatusBadge' => getStatusBadge($newStatus)
            ];

            echo json_encode($response);
        } else {
            $error = "Error updating status: " . $conn->error;
            echo json_encode(['error' => $error]);
        }
        
        exit;
    }
}

function getStatusBadge($status) {
    if ($status === 'on hold') {
        return '<span class="badge badge-warning">On Hold</span>';
    } elseif ($status === 'approved') {
        return '<span class="badge badge-success">Approved</span>';
    } else {
        return '<span class="badge badge-secondary">Unknown</span>';
    }
}
?>
