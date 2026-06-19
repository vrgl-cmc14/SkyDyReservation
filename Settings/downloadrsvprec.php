<?php
require 'db_connect.php';

$sql = "SELECT * FROM reservation
        ORDER BY reservation_id ASC";

$result = $conn->query($sql);

$filename = "reservationDetails_" . date("Y-m-d") . ".csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

$output = fopen('php://output', 'w');

fputcsv($output, [
    'Reservation ID', 'Space Name', 'Status', 'Date', 'Time', 'Expected Timeout'
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
