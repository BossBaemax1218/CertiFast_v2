<?php

require("../server/server.php");

$query = "SELECT CONCAT(lastname,',', firstname,' ',middlename) AS Fullname, address, birthdate, age, gender, civilstatus, purok, residency_status FROM tblresident";
if (!$result = $conn->query($query)) {
    exit($conn->error);
}

$users = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Barangay_Purok_Resident.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('Fullname','Address',  'Birthdate', 'Age', 'Gender',  'Email',  'Purok', 'Status'));

if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}

?>