<?php
require 'db_connect.php';


$sql = "SELECT r.*, s.space_name 
        FROM reservation r
        JOIN space s ON r.space_id = s.space_id
        WHERE DATE(r.reservation_date) = CURDATE()
        ORDER BY r.reservation_time ASC";
$result = $conn->query($sql);

echo "<br>";
echo "<h2 style='text-align:center; letter-spacing:2px  '> CURRENT RESERVATIONS </h2>";
echo "<br>";

if ($result->num_rows > 0) {
    $groups = [
        "Confirmed" => [],
        "Pending"   => [],
        "Cancelled" => []
    ];

    while($row = $result->fetch_assoc()) {
        $status = ucfirst(strtolower($row['reservation_status']));
        if (isset($groups[$status])) {
            $groups[$status][] = $row;
        }
    }

    foreach ($groups as $status => $rows) {
        echo "<p style='margin-top:20px; font-weight:bold; text-transform:uppercase;'>$status RESERVATIONS</p>";

        if (count($rows) > 0) {

            echo "<div style='display:flex; flex-direction:row; gap:0; margin-top:15px; margin-bottom:0; padding:4px;'>";
            echo "<div style='flex:1; padding:5px; text-align:center; font-size:13px'><strong>RESERVATION ID</strong></div>";
            echo "<div style='flex:1; padding:5px; text-align:center; font-size:13px'><strong>SPACE NAME</strong></div>";
            echo "<div style='flex:1; padding:5px; text-align:center; font-size:13px'><strong>RESERVATION STATUS</strong></div>";
            echo "<div style='flex:1; padding:5px; text-align:center; font-size:13px'><strong>RESERVATION DATE</strong></div>";
            echo "<div style='flex:1; padding:5px; text-align:center; font-size:13px'><strong>RESERVATION TIME</strong></div>";
            echo "<div style='flex:1; padding:5px; text-align:center; font-size:13px'><strong>EXPECTED TIME OUT</strong></div>";
            echo "<div style='flex:1; padding:5px; text-align:center; font-size:13px'><strong>DETAILS</strong></div>";
            echo "</div><hr>";

            foreach ($rows as $row) {
                echo "<div style='display:flex; flex-direction:row; gap:0; margin-bottom:0; padding:4px'>";
                echo "<div style='flex:1; padding:5px; text-align:center; font-size:12px'>" . htmlspecialchars($row['reservation_id']) . "</div>";
                echo "<div style='flex:1; padding:5px; text-align:center; font-size:12px'>" . htmlspecialchars($row['space_name']) . "</div>"; 
                echo "<div style='flex:1; padding:5px; text-align:center; font-size:12px'>" . htmlspecialchars($row['reservation_status']) . "</div>";
                echo "<div style='flex:1; padding:5px; text-align:center; font-size:12px'>" . htmlspecialchars($row['reservation_date']) . "</div>";
                echo "<div style='flex:1; padding:5px; text-align:center; font-size:12px'>" . htmlspecialchars($row['reservation_time']) . "</div>";
                echo "<div style='flex:1; padding:5px; text-align:center; font-size:12px'>" . htmlspecialchars($row['expected_timeout']) . "</div>";
                echo "<div style='flex:1; padding:5px; text-align:center;'><button class='editRecord' onclick=\"location.href='viewrsvpdetails.php?id=" . $row['reservation_id'] . "'\"> EDIT </button></div>";
                echo "</div><hr>";
            }

            echo "<br>";
        } else {
            echo "<p>No $status reservations found today.</p>";
            echo "<br>";
        }
    }
} else {
    echo "<p class='noRes'>No current reservations found </p>";
}

$conn->close();
?>
