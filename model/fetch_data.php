<?php
// Retrieve the selected date from the AJAX request
$date = $_POST['date'];

// Convert the selected date to the proper format for comparison in the SQL query
$formattedDate = date('Y-m-d', strtotime($date));

// Prepare and execute the SQL query to fetch data for the selected date
$paymentDataQuery = "SELECT details, COUNT(*) AS total_payments FROM tblpayments WHERE DATE(date) = ? GROUP BY details";
$stmt = $conn->prepare($paymentDataQuery);
$stmt->bind_param("s", $formattedDate);
$stmt->execute();
$paymentDataResult = $stmt->get_result();

$labels = [];
$datasets = [];

if ($paymentDataResult->num_rows > 0) {
    while ($row = $paymentDataResult->fetch_assoc()) {
        $barangay = $row['details'];

        if (!isset($datasets[$barangay])) {
            $datasets[$barangay] = [];
        }

        $datasets[$barangay][] = $row['total_payments'];
    }

    // Extract the unique barangays as labels
    $labels = array_keys($datasets);
} else {
    echo json_encode(['labels' => [], 'datasets' => []]);
    exit;
}

// Prepare the data in the required format for the chart
$chartData = [
    'labels' => $labels,
    'datasets' => []
];

foreach ($datasets as $barangay => $data) {
    $chartData['datasets'][] = [
        'label' => $barangay,
        'data' => $data,
        'backgroundColor' => getRandomColor(),
        'borderColor' => getRandomColor(),
        'borderWidth' => 1
    ];
}

// Send the data as JSON response
echo json_encode($chartData);
exit;

// Function to generate random colors
function getRandomColor()
{
    $letters = "0123456789ABCDEF";
    $color = "#";
    for ($i = 0; $i < 6; $i++) {
        $color .= $letters[rand(0, 15)];
    }
    return $color;
}