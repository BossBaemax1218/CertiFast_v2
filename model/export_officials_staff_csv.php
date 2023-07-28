<?php

require("../server/server.php");

$query = "SELECT fullname,position,address,termstart,termend,status FROM tblofficials";
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
header('Content-Disposition: attachment; filename=Barangay_Officials_Staff.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('Fullname', 'Position','Address','Term Start', 'Term End', 'Status'));

if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}

?>