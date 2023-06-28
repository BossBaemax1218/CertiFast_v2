<?php

require("../server/server.php");
require_once('../PHPMailer/tcpdf/src/tcpdf.php');

$query = "SELECT date, name, details, amounts, user FROM tblpayments";
if (!$result = $conn->query($query)) {
    exit($conn->error);
}

$users = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('Your Creator');
$pdf->SetAuthor('Your Author');
$pdf->SetTitle('Payments');
$pdf->SetSubject('Payments Data');
$pdf->SetKeywords('Payments, Data');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();

$pdf->SetFont('helvetica', '', 10);

$html = '<table>
    <tr>
        <th>Date</th>
        <th>Name</th>
        <th>Details</th>
        <th>Amount</th>
        <th>Cashier</th>
    </tr>';

foreach ($users as $row) {
    $html .= '<tr>';
    $html .= '<td>' . $row['date'] . '</td>';
    $html .= '<td>' . $row['name'] . '</td>';
    $html .= '<td>' . $row['details'] . '</td>';
    $html .= '<td>' . $row['amounts'] . '</td>';
    $html .= '<td>' . $row['user'] . '</td>';
    $html .= '</tr>';
}

$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('Payments.pdf', 'D');

?>
