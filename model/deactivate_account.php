<?php
// Include the server.php file that contains your database connection
include '../server/server.php';

if (isset($_POST['submit'])) {
    if ($_POST['submit'] === 'Deactivate') {
        // Get the user's email and purok from the form
        $userEmail = isset($_POST['email']) ? $_POST['email'] : '';
        $userPurok = isset($_POST['purok']) ? $_POST['purok'] : '';

        // Assuming you have a function to deactivate the user's account
        if (deactivateAccount($userEmail, $userPurok)) {
            // Account deactivation successful
            echo "Account has been deactivated.";
            
            // Call the function to perform cleanup for inactive users
            cleanupInactiveUsers();
        } else {
            // Account deactivation failed
            echo "Failed to deactivate account.";
        }
    }
}

// Define the deactivateAccount function
function deactivateAccount($email, $purok) {
    global $connection; // Assuming $connection is defined in server.php
    
    // Start a transaction to ensure consistency
    $connection->begin_transaction();

    try {
        $tablesToUpdateIn = [
            'tblbirthcert', 'tblbrgy_id', 'tblclearance', 'tbldeath', 'tblfamily_tax',
            'tblfirstjob', 'tblgood_moral', 'tblindigency', 'tbllive_in', 'tbloath',
            'tblofficials', 'tblpayments', 'tblpermit', 'tblresidency', 'tblresident',
            'tblresident_requested', 'tbl_trash', 'tbl_trash_reqcert', 'tbl_trash_support',
            'tbl_trash_trans', 'tbl_user_resident'
        ];
        
        // Update timestamp for deactivation
        $sqlUpdate = "UPDATE tbl_user_resident SET is_active = 0, deactivation_date = NOW() WHERE email = ? AND purok = ?";
        $stmtUpdate = $connection->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ss", $email, $purok);
        $stmtUpdate->execute();
        $stmtUpdate->close();

        // Commit the transaction if the update was successful
        $connection->commit();
        return true;
    } catch (Exception $e) {
        // Rollback the transaction on error
        $connection->rollback();
        return false;
    }
}

// Logic to handle account deletion after 7 days
function cleanupInactiveUsers() {
    global $connection; // Assuming $connection is defined in server.php
    
    // Start a transaction to ensure consistency
    $connection->begin_transaction();

    try {
        $tablesToDeleteFrom = [
            'tblbirthcert', 'tblbrgy_id', 'tblclearance', 'tbldeath', 'tblfamily_tax',
            'tblfirstjob', 'tblgood_moral', 'tblindigency', 'tbllive_in', 'tbloath',
            'tblofficials', 'tblpayments', 'tblpermit', 'tblresidency', 'tblresident',
            'tblresident_requested', 'tbl_trash', 'tbl_trash_reqcert', 'tbl_trash_support',
            'tbl_trash_trans'
        ];
        
        $sevenDaysAgo = date('Y-m-d H:i:s', strtotime('-7 days'));

        foreach ($tablesToDeleteFrom as $table) {
            if ($table === 'tbl_user_resident') {
                $sql = "UPDATE $table SET is_active = 0, deactivation_date = NOW() WHERE deactivation_date <= ? AND email NOT IN (SELECT email FROM tbl_user_resident WHERE last_login >= DATE_SUB(NOW(), INTERVAL 7 DAY))";
            } else {
                $sql = "DELETE FROM $table WHERE email NOT IN (SELECT email FROM tbl_user_resident WHERE last_login >= DATE_SUB(NOW(), INTERVAL 7 DAY))";
            }
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("s", $sevenDaysAgo);
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
