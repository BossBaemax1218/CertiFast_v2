<?php
include '../server/server.php';

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$brgy_id = $conn->real_escape_string($_POST['barangayid']);
$name = $conn->real_escape_string($_POST['fullname']);
$pos = $conn->real_escape_string($_POST['position']);
$address = $conn->real_escape_string($_POST['address']);
$start = $conn->real_escape_string($_POST['start']);
$end = $conn->real_escape_string($_POST['end']);
$status = $conn->real_escape_string($_POST['status']);
$profile = $conn->real_escape_string($_POST['picture']); 
$profile2 = ($_FILES['image']['name'] ?? null);

$newName = date('dmYHis') . str_replace(" ", "", $profile2);

if (!empty($name)) {
    if (!empty($profile) && !empty($profile2)) {
        $query = "INSERT INTO tblofficials (`picture`, `barangay_id`, `fullname`, `position`, `address`, `termstart`, `termend`, `status`) 
            VALUES ('$profile', '$brgy_id', '$name', '$pos', '$address', '$start', '$end', '$status')";
    } else if (!empty($profile) && empty($profile2)) {
        $query = "INSERT INTO tblofficials (`picture`, `barangay_id`, `fullname`, `position`, `address`, `termstart`, `termend`, `status`) 
            VALUES ('$profile', '$brgy_id', '$name', '$pos', '$address', '$start', '$end', '$status')";
    } else if (empty($profile) && !empty($profile2)) {
        $query = "INSERT INTO tblofficials (`picture`, `barangay_id`, `fullname`, `position`, `address`, `termstart`, `termend`, `status`) 
            VALUES ('$newName', '$brgy_id', '$name', '$pos', '$address', '$start', '$end', '$status')";
        if (move_uploaded_file($_FILES['image']['tmp_name'], "../assets/uploads/officials_profile/" . $newName)) {
            $_SESSION['message'] = 'Barangay Officials has been saved!';
            $_SESSION['success'] = 'success';
        }
    } else {
        $query = "INSERT INTO tblofficials (`picture`, `barangay_id`, `fullname`, `position`, `address`, `termstart`, `termend`, `status`) 
            VALUES ('person.png', '$brgy_id', '$name', '$pos', '$address', '$start', '$end', '$status')";
    }

    if ($conn->query($query) === true) {
        $_SESSION['message'] = 'Barangay Officials has been saved!';
        $_SESSION['success'] = 'success';
    } else {
        $_SESSION['message'] = 'Error: ' . $conn->error;
        $_SESSION['success'] = 'danger';
    }
} else {
    $_SESSION['message'] = 'Please complete the form!';
    $_SESSION['success'] = 'danger';
}

$conn->close();
header("Location: ../officials.php");
