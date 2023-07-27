<?php
session_start(); // Ensure session is started

include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    exit;
}

$purok = $conn->real_escape_string($_POST['purok']);
$purok_leader = $conn->real_escape_string($_POST['purok_leader']);
$contact_number = $conn->real_escape_string($_POST['contact_number']);
$total_residents = $conn->real_escape_string($_POST['total_residents']);
$total_households = $conn->real_escape_string($_POST['total_households']);
$id = $conn->real_escape_string($_POST['id']);

if (!empty($id)) {
    $query = "UPDATE tblpurok SET `purok` = ?, `total_residents` = ?, `total_households` = ?, `purok_leader` = ?, `contact_number` = ? WHERE id = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("siissi", $purok, $total_residents, $total_households, $purok_leader, $contact_number, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Purok has been updated!';
        $_SESSION['success'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['success'] = 'danger';
    }

    $stmt->close();
} else {
    $_SESSION['message'] = 'No purok ID found!';
    $_SESSION['success'] = 'danger';
}

$conn->close();

header("Location: ../purok.php");
exit;
