<?php
require 'db_connect.php';

$sql = "SELECT s.space_id, s.space_name, s.capacity, s.price,
               w.is_shared, w.has_locker,
               r.soundproof_level
        FROM space s
        LEFT JOIN workspace w ON s.space_id = w.space_id
        LEFT JOIN room r ON s.space_id = r.space_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div style='display: flex; flex-direction: row; gap: 0; margin-top: 15px; margin-bottom: 0; padding: 4px;'>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>SPACE NAME</strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>CAPACITY</strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>PRICE</strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>TYPE</strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>SHARED</strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>LOCKER</strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>SOUNDPROOF LEVEL</strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong></strong></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong></strong></div>";
    echo "</div>";
    echo "<hr>";
    
    while($row = $result->fetch_assoc()) {
    echo "<div style='display: flex; flex-direction: row; gap: 0; margin-bottom: 0; padding: 4px'>";

    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['space_name']) . "</div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['capacity']) . "</div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>₱" . htmlspecialchars($row['price']) . "</div>";

    if ($row['is_shared'] !== null) {
        echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>Workspace</div>";
        echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . ($row['is_shared'] ? 'Yes' : 'No') . "</div>";
        echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . ($row['has_locker'] ? 'Yes' : 'No') . "</div>";
        echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>-</div>";
    } elseif ($row['soundproof_level'] !== null) {
        echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>Room</div>";
        echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>-</div>";
        echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>-</div>";
        echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['soundproof_level']) . "</div>";
    } else {
        echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>-</div>";
        echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>-</div>";
        echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>-</div>";
        echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>-</div>";
    }

    echo "<div style='flex: 1; padding: 5px; text-align: center;'><button class='editRecord' onclick=\"location.href='editspacedetails.php?id=" . $row['space_id'] . "'\"> EDIT </button></div>";
    echo "<div style='flex: 1; padding: 5px; text-align: center;'><button class='deleteRecord' onclick=\"if(confirm('Are you sure you want to delete this space record? This Cannot be Undone')) location.href='deleteSpaceRecord.php?id=" . $row['space_id'] . "'\"> DELETE </button></div>";

    echo "</div>";
    echo "<hr>";
}


    echo "</div>";

} else {
    echo "<h1 class='noRes'>Empty Spaces</h1>";
}

$conn->close();
?>
