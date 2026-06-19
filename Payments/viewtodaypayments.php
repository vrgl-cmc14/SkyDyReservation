<?php
require 'db_connect.php';

$sql = "SELECT *
        FROM payment
        WHERE DATE(CONVERT_TZ(payment_date_time, '+00:00', '+00:00')) = CURDATE()
        ORDER BY payment_date_time ASC";

$result = $conn->query($sql);

echo "<br>";
echo "<h2 style='text-align:center; letter-spacing:2px  '> TODAY'S RESERVATION INCOME </h2>";
echo "<br>";

if ($result->num_rows > 0) {
    echo "<div style='display: flex; flex-direction: row; gap: 0; margin-top: 15px; margin-bottom: 0; padding: 4px;'>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>PAYMENT ID</strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>RESERVATION ID</strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>REFERENCE CODE</strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>PAYMENT MODE</strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>AMOUNT PAID</strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>PAYMENT DATE-TIME</strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>DETAILS</strong></div>";
    echo "</div>";
    echo "<hr>";
    
    while($row = $result->fetch_assoc()) {
    echo "<div style='display: flex; flex-direction: row; gap: 0; margin-bottom: 0; padding: 4px'>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['payment_id']) . "</div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['reservation_id']) . "</div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['reference_code']) . "</div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['payment_mode']) . "</div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['amount_paid']) . "</div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['payment_date_time']) . "</div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center;'><button class='editRecord' onclick=\"location.href='viewpaymentdetails.php?id=" . $row['payment_id'] . "'\"> VIEW </button></div>";

    echo "</div>";
    echo "<hr>";
}


    echo "</div>";

} else {
    echo "<p>Lorem Ipsum</h1>";
}

$conn->close();
?>
