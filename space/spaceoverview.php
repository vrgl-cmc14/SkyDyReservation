<?php
require 'db_connect.php';

$sql = "SELECT s.space_id, s.space_name, s.capacity, s.price,
               w.is_shared, w.has_locker,
               r.soundproof_level
        FROM space s
        LEFT JOIN workspace w ON s.space_id = w.space_id
        LEFT JOIN room r ON s.space_id = r.space_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap; 
            gap: 20px;     =
        }
        .card {
            flex: 1 1 300px; 
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            background: #f9f9f9;
        }
        .card h2 {
            margin-top: 0;
            font-family: 'Luckiest Guy', cursive;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<h2>" . htmlspecialchars($row['space_name']) . "</h2>";
                echo "Capacity: " . $row['capacity'] . "<br>";
                echo "Price: ₱" . $row['price'] . "<br>";

                if ($row['is_shared'] !== null) {
                    echo "Is Shared: " . ($row['is_shared'] ? "Yes" : "No") . "<br>";
                    echo "Has Locker: " . ($row['has_locker'] ? "Yes" : "No") . "<br>";
                }
                if ($row['soundproof_level'] !== null) {
                    echo "Soundproof Level: " . $row['soundproof_level'] . "<br>";
                }

                echo "</div>";
            }
        } else {
            echo "<p>No spaces found.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
