<?php
require 'db_connect.php';

$sql = "SELECT * FROM customer
        ORDER BY customer_id ASC";

$result = $conn->query($sql);

$filename = "customerDetails" . date("Y-m-d") . ".csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

$output = fopen('php://output', 'w');

fputcsv($output, [
    'Customer ID', 'First Name', 'Middle Name', 'Last Name', 'Suffix', 'Gender', 'Email', 'Phone'
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
