<?php
include('../server/server.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $certificateName = $conn->real_escape_string($_POST['certificate_name']);
    $residentId = $conn->real_escape_string($_POST['id']);

    $tableIdMap = array(
        'barangay clearance' => array('table' => 'tblclearance', 'id_column' => 'c_id'),
        'barangay identification' => array('table' => 'tblidentification', 'id_column' => 'brgy_id'),
        'certificate of residency' => array('table' => 'tblresidency', 'id_column' => 'res_id'),
        'certificate of death' => array('table' => 'tbldeath', 'id_column' => 'death_id'),
        'certificate of birth' => array('table' => 'tblbirthcert', 'id_column' => 'birth_id'),
        'certificate of live in' => array('table' => 'tbllive_in', 'id_column' => 'live_id'),
        'certificate of oath taking' => array('table' => 'tblbrgy_id', 'id_column' => 'oath_id'),
        'family home estate tax' => array('table' => 'tblfamily_tax', 'id_column' => 'fam_id'),
        'certificate of good moral' => array('table' => 'tblgood_moral', 'id_column' => 'good_id'),
        'certificate of indigency' => array('table' => 'tblindigency', 'id_column' => 'indi_id'),
        'business permit' => array('table' => 'tblpermit', 'id_column' => 'id'),
        'first time jobseekers' => array('table' => 'tblfirstjob', 'id_column' => 'job_id'),

    );

    if (isset($tableIdMap[$certificateName])) {
        $tableInfo = $tableIdMap[$certificateName];
        $tableName = $tableInfo['table'];
        $idColumnName = $tableInfo['id_column'];

        $query = "SELECT $idColumnName FROM $tableName WHERE id = $residentId";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $certificateId = $row[$idColumnName];
            $response = array('id' => $certificateId);
            echo json_encode($response);
        } else {
            echo json_encode(array('error' => 'Certificate ID not found.'));
        }
    } else {
        echo json_encode(array('error' => 'Invalid certificate name.'));
    }
}
$conn->close();
?>

<?php 
$sql = "SELECT DISTINCT s.cert_id,
        c1.c_id,
        c2.brgy_id,
        c3.res_id,
        c4.death_id,
        c5.birth_id,
        c6.live_id,
        c7.job_id,
        c8.fam_id,
        c9.good_id,
        c10.indi_id,
        c11.id,
        c12.oath_id
        FROM tblresident AS r
        JOIN tblresident_requested AS s ON r.email = s.email
        LEFT JOIN tblclearance AS c1 ON r.email = c1.email
        LEFT JOIN tblbrgy_id AS c2 ON r.email = c2.email
        LEFT JOIN tblresidency AS c3 ON r.email = c3.email
        LEFT JOIN tbldeath AS c4 ON r.email = c4.email
        LEFT JOIN tblbirthcert AS c5 ON r.email = c5.email
        LEFT JOIN tbllive_in AS c6 ON r.email = c6.email
        LEFT JOIN tblfirstjob AS c7 ON r.email = c7.email
        LEFT JOIN tblfamily_tax AS c8 ON r.email = c8.email
        LEFT JOIN tblgood_moral AS c9 ON r.email = c9.email
        LEFT JOIN tblindigency AS c10 ON r.email = c10.email
        LEFT JOIN tblpermit AS c11 ON r.email = c11.email
        LEFT JOIN tbloath AS c12 ON r.email = c12.email
        WHERE s.status IN ('on hold', 'approved') AND r.certificate_name != 'business permit'";
        $result = $conn->query($sql);

$resident = array();
while ($row = $result->fetch_assoc()) {
    $status = $row['status'];
    $statusBadge = '';

    if ($status === 'on hold') {
        $statusBadge = '<span class="badge badge-warning">On Hold</span>';
    } elseif ($status === 'approved') {
        $statusBadge = '<span class="badge badge-success">Approved</span>';
    } else {
        $statusBadge = '<span class="badge badge-secondary">Unknown</span>';
    }

    $row['residency_badge'] = $statusBadge;

    if ($status == 'on hold') {
        $resident[] = $row;
    } elseif ($status == 'approved') {
        $resident[] = $row;
    } elseif ($status == 'claimed') {
        $resident[] = $row;
    }
}
?>