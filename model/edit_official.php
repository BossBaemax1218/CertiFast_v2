<?php
include '../server/server.php';

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$id = $conn->real_escape_string($_POST['id']);
$brgy_id = $conn->real_escape_string($_POST['barangayid']);
$name = $conn->real_escape_string($_POST['fullname']);
$pos = $conn->real_escape_string($_POST['position']);
$address = $conn->real_escape_string($_POST['address']);
$start = $conn->real_escape_string($_POST['start']);
$end = $conn->real_escape_string($_POST['end']);
$status = $conn->real_escape_string($_POST['status']);
$profile = $conn->real_escape_string($_POST['picture']); // base64 image
$profile2 = ($_FILES['image']['name'] ?? null);

// change profile2 name
$newName = date('dmYHis') . str_replace(" ", "", $profile2);

$check = "SELECT id FROM tblofficials WHERE barangay_id='$brgy_id'";
$result = $conn->query($check);
$officials = ($result !== false) ? $result->num_rows : 0;

if ($officials['barangay_id'] == $brgy_id || $officials <= 0) {
    if (!empty($id)) {
        if (!empty($profile) && !empty($profile2)) {
            $query = "UPDATE tblofficials SET `picture`='$profile', `barangay_id`='$brgy_id', `fullname`='$name', `position`='$pos', `address`='$address', termstart='$start', termend='$end', `status`='$status' WHERE id=$id;";
        } else if (!empty($profile) && empty($profile2)) {
            $query = "UPDATE tblofficials SET `picture`='$profile', `barangay_id`='$brgy_id', `fullname`='$name', `position`='$pos', `address`='$address', termstart='$start', termend='$end', `status`='$status' WHERE id=$id;";
        } else if (empty($profile) && !empty($profile2)) {
            $query = "UPDATE tblofficials SET `picture`='$newName', `barangay_id`='$brgy_id', `fullname`='$name', `position`='$pos', `address`='$address', termstart='$start', termend='$end', `status`='$status' WHERE id=$id;";
            if (move_uploaded_file($_FILES['image']['tmp_name'], "../assets/uploads/officials_profile/" . $newName)) {
                $_SESSION['message'] = 'Barangay Officials information has been updated!';
                $_SESSION['success'] = 'success';
            }
        } else {
            $query = "UPDATE tblofficials SET `fullname`='$name', `barangay_id`='$brgy_id', `position`='$pos', `address`='$address', termstart='$start', termend='$end', `status`='$status' WHERE id=$id;";
        }

        if ($conn->query($query) === true) {
            $_SESSION['message'] = 'Barangay Officials information has been updated!';
            $_SESSION['success'] = 'success';
        } else {
            $_SESSION['message'] = 'Error: ' . $conn->error;
            $_SESSION['success'] = 'danger';
        }
    } else {
        $_SESSION['message'] = 'Please complete the form!';
        $_SESSION['success'] = 'danger';
    }
} else {
    $_SESSION['message'] = 'ID is already taken. Please enter a unique ID!';
    $_SESSION['success'] = 'danger';
}

$conn->close();
header("Location: ../officials.php");
