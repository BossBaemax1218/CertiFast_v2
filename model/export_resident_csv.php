<?php

require("../server/server.php");

$query = "SELECT national_id,firstname,middlename,lastname,address,birthplace,birthdate,age,civilstatus,gender,purok,voterstatus,taxno,phone,email FROM tblresident";
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
header('Content-Disposition: attachment; filename=Residents.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('National ID', 'First Name','Middle Name', 'Last Name', 'Address', 'Birtplace', 'Birthdate', 'Age', 'Civil Status', 'Gender', 'Purok', 'Voter Status', 'Tax no.', 'Contact Number', 'Email'));

if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}

?>