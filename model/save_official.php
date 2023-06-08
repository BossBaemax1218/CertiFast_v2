<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$name = $conn->real_escape_string($_POST['fullname']);
$pos = $conn->real_escape_string($_POST['position']);
$start = $conn->real_escape_string($_POST['start']);
$end = $conn->real_escape_string($_POST['end']);
$status = $conn->real_escape_string($_POST['status']);
$profile = $conn->real_escape_string($_POST['profile-image']); // base 64 image
$profile2 = $_FILES['img']['name'];
// change profile2 name
$newName = date('dmYHis').str_replace(" ", "", $profile2);

// image file directory
$target = "../assets/uploads/officials/".basename($newName);

if (!empty($name) && !empty($pos) && !empty($start) && !empty($end) && !empty($status)) {

    $query = "SELECT * FROM tblofficials WHERE fullname='$name'";
    $res = $conn->query($query);

    if ($res->num_rows) {
        $_SESSION['message'] = 'Please enter your real name!';
        $_SESSION['success'] = 'danger';
    } else {
        if (!empty($profile) && !empty($profile2)) {
            $insert = "INSERT INTO tblofficials (`fullname`, `position`, `photo`, `termstart`, `termend`, `status`) VALUES ('$name', '$pos', '$profile', '$start', '$end', '$status')";
            $result = $conn->query($insert);

            if ($result == true) {
                $_SESSION['message'] = 'Official added!';
                $_SESSION['success'] = 'success';
            } else {
                $_SESSION['message'] = 'Something went wrong!';
                $_SESSION['success'] = 'danger';
            }
        } else if (!empty($profile) && empty($profile2)) {
            $insert = "INSERT INTO tblofficials (`fullname`, `position`, `photo`, `termstart`, `termend`, `status`) VALUES ('$name', '$pos', '$profile', '$start', '$end', '$status')";
            $result = $conn->query($insert);

            if ($result == true) {
                $_SESSION['message'] = 'Official added!';
                $_SESSION['success'] = 'success';
            } else {
                $_SESSION['message'] = 'Something went wrong!';
                $_SESSION['success'] = 'danger';
            }
        } else if (empty($profile) && !empty($profile2)) {
            $moved = move_uploaded_file($_FILES['img']['tmp_name'], $target);

            if ($moved) {
                $insert = "INSERT INTO tblofficials (`fullname`, `position`, `photo`, `termstart`, `termend`, `status`) VALUES ('$name', '$pos', '$newName', '$start', '$end', '$status')";
                $result = $conn->query($insert);

                if ($result == true) {
                    $_SESSION['message'] = 'Official added!';
                    $_SESSION['success'] = 'success';
                } else {
                    $_SESSION['message'] = 'Something went wrong!';
                    $_SESSION['success'] = 'danger';
                }
            } else {
                $_SESSION['message'] = 'Failed to move the uploaded file!';
                $_SESSION['success'] = 'danger';
            }
        } else {
            $insert = "INSERT INTO tblofficials (`fullname`, `position`, `photo`, `termstart`, `termend`, `status`) VALUES ('$name', '$pos', 'person.png', '$start', '$end', '$status')";
            $result = $conn->query($insert);

            if ($result == true) {
                $_SESSION['message'] = 'Official added!';
                $_SESSION['success'] = 'success';
            } else {
                $_SESSION['message'] = 'Something went wrong!';
                $_SESSION['success'] = 'danger';
            }
        }
    }
} else {
    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../officials.php");

$conn->close();
?>
