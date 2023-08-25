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
    $cert_name = $conn->real_escape_string($_POST['certificate_name']);
    $req = $conn->real_escape_string($_POST['requirement']);

    $id = $_POST['id'];

    $statusMapping = [
        'on hold' => 'on hold',           
        'operating' => 'claimed',
        'suspened' => 'rejected',    
        'closed' => 'rejected', 
    ];

    if (isset($statusMapping[$status])) {
        $mappedStatus = $statusMapping[$status];

        $permit_update_query = "UPDATE tblpermit SET 
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

        $permit_update_result = $conn->query($permit_update_query);

        $resident_update_query = "UPDATE tblresident_requested SET status = '$mappedStatus' WHERE requirement = '$req' AND certificate_name = '$cert_name' LIMIT 1";
        $resident_update_result = $conn->query($resident_update_query);

        if ($permit_update_result === true && $resident_update_result === true) {
            $_SESSION['message'] = 'Business Permit updated successfully!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Something went wrong during the update!';
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Invalid status provided!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../business_permit.php");
    $conn->close();
} else {
    header("Location: ../business_permit.php");
}
?>
