<?php
require 'db_connect.php';

$space_name = $_POST['space_name'];
$capacity   = $_POST['capacity'];
$price      = $_POST['price'];
$category   = $_POST['category'];

$message = "";

try {
    $sql = "INSERT INTO space (space_name, capacity, price) VALUES ('$space_name', '$capacity', '$price')";
    if ($conn->query($sql) === TRUE) {
        $space_id = $conn->insert_id; 

        if ($category === "Workspace") {
            $is_shared  = ($_POST['is_shared'] === "yes") ? 1 : 0;
            $has_locker = ($_POST['has_locker'] === "yes") ? 1 : 0;
            $conn->query("INSERT INTO workspace (space_id, is_shared, has_locker)
                          VALUES ('$space_id', '$is_shared', '$has_locker')");
        } elseif ($category === "Room") {
            $soundproof_level = $_POST['soundproofLevel'];
            $conn->query("INSERT INTO room (space_id, soundproof_level)
                          VALUES ('$space_id', '$soundproof_level')");
        }

        $message = "<p style='font-size: 20px; text-align:center;'>A SPACE HAS BEEN ADDED SUCCESSFULLY.</p>";
    } else {
        $message = "<p style='font-size: 20px; text-align:center;'>AN UNIDENTIFIED ERROR EXISTS</p>";
    }
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) {
        $message = "<p style='font-size: 20px; text-align:center;'>YOUR RECENTLY ADDED SPACE RECORD SEEMS TO BE A DUPLICATE, THEREFORE, IT HAS NOT BEEN ADDED TO THE RECORDS</p>";
    } else {
        $message = "<p style='font-size: 20px; text-align:center;'>AN UNIDENTIFIED ERROR EXISTS</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css"> 
    <script>
        function spaceoverview(){
            window.open("spaceoverview.html", "_self");
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&family=Cherry+Bomb+One&display=swap" rel="stylesheet">
</head>
<script>
            
            function openOverview(){
                window.open("../Admin/index.php", "_self");
            } 
            function openSpace(){
                window.open("../space/spaceoverview.html", "_self");
            } 

            function openRates(){
                window.open("../Rates/readdisplayrecords.php", "_self");
            } 

            function openReservations(){
                window.open("../Reservations/reservation.html", "_self");
            } 

            function openPayments(){
                window.open("../payments/payments.html", "_self");
            } 

            function openSettings(){
                window.open("../settings/settings.html", "_self");
            } 
            function openRecent(){
                window.open("displayrecentreservation.php", "_self")
            }
            function openFuture(){
                window.open("displayfuturereservation.php", "_self")
            }
        </script>
<body>
    <div class="parent">
        <div class="child1">
            <div class="grandchild1">
                <div class="grandchild2">
                    <img src="../assets/skydylogo.png" width="100px">
                </div>
            </div>
            <div class="grandchild3">
                    <button class="dashboardButton" onclick="openOverview()">OVERVIEW</button>
                    <button class="ChosendashboardButton" onclick="openSpace()">SPACE</button>
                    <button class="dashboardButton" onclick="openRates()">RATES</button>
                    <button class="dashboardButton" onclick="openReservations()">RESERVATION</button>
                    <button class="dashboardButton" onclick="openPayments()">PAYMENTS</button>
                    <button class="dashboardButton" onclick="openSettings()">SETTINGS</button>
                </div>
        </div>
        <div class="child2">
            <div class="headerChild2">
                <p class="headerText" style="color: #3B71CA">.</p>
                <div class="grandchild4">
                    <div class="grandchild5">
                        <div class="grandchild6">
                            <br>
                            <div class="gitna">
                                <?php echo $message; ?>
                            </div>
                            <div class="gitna">
                                <button class="backbackback" onclick="openSpace()">BACK</button>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
