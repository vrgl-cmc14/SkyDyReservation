<?php
require 'db_connect.php';

$sql = "SELECT * FROM payment
        ORDER BY payment_id ASC";

$result = $conn->query($sql);

$filename = "paymentDetails" . date("Y-m-d") . ".csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

$output = fopen('php://output', 'w');

fputcsv($output, [
    'Payment ID', 'Reference Code', 'Amount Paid', 'Payment Mode', 'Payment Date/Time'
]);

while ($row = $result->fetch_assoc()) {
    foreach ($row as $key => $value) {
        $row[$key] = $value !== null ? $value : "-";
    }
    fputcsv($output, $row);
}

fclose($output);
$conn->close();
?>
