<?php
require 'db_connect.php';

if (!isset($_GET['id'])) {
    echo "No record selected.";
    exit;
}

$id = intval($_GET['id']);

$sql = "SELECT s.space_id, s.space_name, s.capacity, s.price,
               w.is_shared, w.has_locker,
               r.soundproof_level
        FROM space s
        LEFT JOIN workspace w ON s.space_id = w.space_id
        LEFT JOIN room r ON s.space_id = r.space_id
        WHERE s.space_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="update.css">
        <script src="formspace.js"></script>
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
                    <button class="dashboardButton"       onclick="openOverview()">OVERVIEW</button>
                    <button class="ChosendashboardButton" onclick="openSpace()">SPACE</button>
                    <button class="dashboardButton"       onclick="openRates()">RATES</button>
                    <button class="dashboardButton"       onclick="openReservations()">RESERVATION</button>
                    <button class="dashboardButton"       onclick="openPayments()">PAYMENTS</button>
                    <button class="dashboardButton"       onclick="openSettings()">SETTINGS</button>
                </div>
            </div>
            <div class="child2">
                <div class="headerChild2">
                    <p class="headerText" style="color: #3B71CA">.</p>
                    <div class="grandchild4">
                        <br>
                        <button class="backButton" onclick="back()">BACK</button>
                        
                        <div class="grandchild5">
                            <br>
                        <div class=formm>
                            <form method="POST" action="updatespace.php" 
                                onsubmit="return confirm('Changing type will delete the other record. Continue?');">
                                <input type="hidden" name="space_id" value="<?php echo $row['space_id']; ?>">

                                <label for="space_name">SPACE NAME <span style="color: darkred">  * </span></label><br>
                                <input type="text" id="space_name" name="space_name" class="datafieldText" placeholder="Example: Sky Circle 1"
                                    value="<?php echo htmlspecialchars($row['space_name']); ?>" required><br><br>

                                <label for="capacity">CAPACITY <span style="color: darkred">  * </span> </label><br>
                                <input type="number" min="1" max="20" id="capacity" name="capacity" class="datafieldText" placeholder="Example: 1"
                                    value="<?php echo $row['capacity']; ?>" required><br><br>

                                <label for="price">PRICE</label> <span style="color: darkred">  * </span> <br>
                                <input type="number" min="1" id="price" name="price" class="datafieldText" placeholder="Example: 249"
                                    value="<?php echo $row['price']; ?>" required><br><br>

                                    <br>
                                <label>CATEGORY: <span style="color: darkred">  * </span> </label><br>
                                <input type="radio" id="workspace" name="category" value="Workspace" 
                                    onclick="workspaceDetails()" required>
                                <label for="workspace">Workspace</label>
                                <br>
                                <input type="radio" id="room" name="category" value="Room"
                                    onclick="roomDetails()">
                                <label for="room">Room</label>
                                <br>
                                <div id="spaceFormm"></div>
                                <br>
                                <input type="submit" class="submitButton" value="UPDATE">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>