<?php
include('../server/server.php');

if (!isset($_SESSION['fullname'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $permit_number = $conn->real_escape_string($_POST['permit_number']);
    $business_name = $conn->real_escape_string($_POST['business_name']);
    $owner1 = $conn->real_escape_string($_POST['owner1']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $location = $conn->real_escape_string($_POST['location']);
    $applied = $conn->real_escape_string($_POST['applied']);
    $community_tax = $conn->real_escape_string($_POST['community_tax']);
    $issued_on = $conn->real_escape_string($_POST['issued_on']);
    $issued_at = $conn->real_escape_string($_POST['issued_at']);
    $validation = $conn->real_escape_string($_POST['validation']);
    $status = $conn->real_escape_string($_POST['status']);

    $id = $_POST['id'];

    // Check if the record with the given ID exists in the database
    $check_query = "SELECT COUNT(*) AS count FROM tblpermit WHERE id = $id";
    $check_result = $conn->query($check_query);
    $row = $check_result->fetch_assoc();
    $record_count = $row['count'];

    if ($record_count > 0) {
        // If the record exists, update it
        $update_query = "UPDATE tblpermit SET 
                            permit_number = '$permit_number',
                            business_name = '$business_name',
                            owner1 = '$owner1',
                            email = '$email',
                            address = '$address',
                            location = '$location',
                            applied = '$applied',
                            community_tax = '$community_tax',
                            issued_on = '$issued_on',
                            issued_at = '$issued_at',
                            validation = '$validation',
                            status = '$status'
                        WHERE id = $id";

        $result = $conn->query($update_query);

        if ($result === true) {
            $_SESSION['message'] = 'Business Permit updated successfully!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Something went wrong during the update!';
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'No record found with the provided ID. Update failed!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../business_permit.php");
    $conn->close();
} else {
    // Redirect back if the form was not submitted properly
    header("Location: ../business_permit.php");
}
