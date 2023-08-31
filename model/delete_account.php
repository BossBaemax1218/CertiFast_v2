<?php
include '../server/server.php';

if (isset($_POST['submit'])) {
    if ($_POST['submit'] === 'Delete') {
        $userEmail = isset($_POST['email']) ? $_POST['email'] : '';
        $userPurok = isset($_POST['purok']) ? $_POST['purok'] : '';

        if (deleteUserAndData($userEmail, $userPurok)) {
            echo "User account and associated data have been deleted.";
        } else {
            echo "Failed to delete user account and associated data.";
        }
    }
}

function deleteUserAndData($email, $purok) {
    global $connection;

    $connection->begin_transaction();

    try {
        $tablesToDeleteFrom = [
            'tblbirthcert', 'tblbrgy_id', 'tblclearance', 'tbldeath', 'tblfamily_tax',
            'tblfirstjob', 'tblgood_moral', 'tblindigency', 'tbllive_in', 'tbloath',
            'tblofficials', 'tblpayments', 'tblpermit', 'tblresidency', 'tblresident',
            'tblresident_requested', 'tbl_trash', 'tbl_trash_reqcert', 'tbl_trash_support',
            'tbl_trash_trans', 'tbl_user_resident'
        ];
        
        foreach ($tablesToDeleteFrom as $table) {
            $sql = "DELETE FROM $table WHERE email = ? AND purok = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ss", $email, $purok);
            $stmt->execute();
            $stmt->close();
        }
        $connection->commit();
        return true;
    } catch (Exception $e) {
        $connection->rollback();
        return false;
    }
}

?>
