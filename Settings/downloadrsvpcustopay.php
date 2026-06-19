<?php
require 'db_connect.php';

$sql = "SELECT r.reservation_id, s.space_name, r.reservation_status, r.reservation_date, 
               r.reservation_time, r.expected_timeout,
               c.customer_id, c.first_name, c.middle_name, c.last_name, c.suffix, c.gender,
               c.email_address, c.phone_number,
               p.payment_id, p.reference_code, p.amount_paid, p.payment_mode, p.payment_date_time
        FROM reservation r
        JOIN space s ON r.space_id = s.space_id
        LEFT JOIN customer c ON r.reservation_id = c.reservation_id
        LEFT JOIN payment p ON r.reservation_id = p.reservation_id
        ORDER BY r.reservation_id ASC";

$result = $conn->query($sql);

$filename = "reservations_" . date("Y-m-d") . ".csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

$output = fopen('php://output', 'w');

fputcsv($output, [
    'Reservation ID', 'Space Name', 'Status', 'Date', 'Time', 'Expected Timeout',
    'Customer ID', 'First Name', 'Middle Name', 'Last Name', 'Suffix', 'Gender', 'Email', 'Phone',
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
