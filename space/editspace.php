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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Space</title>
    <link rel="stylesheet" href="editspace.css"> 
    <script src="formspace.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&family=Cherry+Bomb+One&display=swap" rel="stylesheet">
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
</head>
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

    <div class="child2">
        <div class="headerChild2">
            <p class="headerText" style="color: #3B71CA">EDIT SPACE</p>
            <div class="grandchild4">
                <button onclick="back()" class="backbutton">BACK</button>


                <?php if (!empty($row)) { ?>
                    <h2>Current Details</h2>
                    <p><strong>Space ID:</strong> <?php echo htmlspecialchars($row['space_id']); ?></p>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($row['space_name']); ?></p>
                    <p><strong>Capacity:</strong> <?php echo $row['capacity']; ?></p>
                    <p><strong>Price:</strong> <?php echo $row['price']; ?></p>

                    <?php if ($row['is_shared'] !== null): ?>
                        <p><strong>Type:</strong> Workspace (<?php echo $row['is_shared'] ? "Shared" : "Private"; ?>)</p>
                        <p><strong>Locker:</strong> <?php echo $row['has_locker'] ? "Yes" : "No"; ?></p>
                    <?php elseif ($row['soundproof_level'] !== null): ?>
                        <p><strong>Type:</strong> Room</p>
                        <p><strong>Soundproof Level:</strong> <?php echo htmlspecialchars($row['soundproof_level']); ?></p>
                    <?php else: ?>
                        <p><strong>Type:</strong> Undefined</p>
                    <?php endif; ?>
                <?php } else { ?>
                    <p>No record found.</p>
                <?php } ?>

                <div class="grandchild5">
                    <form method="POST" action="updatespace.php" 
                          onsubmit="return confirm('Changing type will delete the other record. Continue?');">
                        <input type="hidden" name="space_id" value="<?php echo $row['space_id']; ?>">

                        <label for="space_name">Space Name</label><br>
                        <input type="text" id="space_name" name="space_name" class="datafieldText"
                               value="<?php echo htmlspecialchars($row['space_name']); ?>" required><br><br>

                        <label for="capacity">Capacity</label><br>
                        <input type="number" min="1" max="20" id="capacity" name="capacity" 
                               value="<?php echo $row['capacity']; ?>" required><br><br>

                        <label for="price">Price</label><br>
                        <input type="number" min="1" id="price" name="price" 
                               value="<?php echo $row['price']; ?>" required><br><br>

                        <label>Type:</label><br>
                        <input type="radio" id="workspace" name="category" value="Workspace"
                               <?php if ($row['is_shared'] !== null) echo "checked"; ?>
                               onclick="workspaceDetails()" required>
                        <label for="workspace">Workspace</label>

                        <input type="radio" id="room" name="category" value="Room"
                               <?php if ($row['soundproof_level'] !== null) echo "checked"; ?>
                               onclick="roomDetails()">
                        <label for="room">Room</label>

                        <div id="spaceFormm"></div>

                        <input type="submit" value="Update">
                    </form>
                </div>

                <?php if ($row['is_shared'] !== null): ?>
                    <script>workspaceDetails();</script>
                <?php elseif ($row['soundproof_level'] !== null): ?>
                    <script>roomDetails();</script>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
