<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css"> 
        <script src="spaceForm.js"></script>

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
             window.open("displayrecentreservation.php", "_self"); 
        }
        function openFuture(){
             window.open("displayfuturereservation.php", "_self"); 
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
                            <br>
                            <?php
                                require 'db_connect.php';
                                $message = "";

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $space_id   = intval($_POST['space_id']);
                                    $space_name = trim($_POST['space_name']);
                                    $capacity   = intval($_POST['capacity']);
                                    $price      = intval($_POST['price']);
                                    $category   = $_POST['category'];

                                    $dupCheck = $conn->prepare("SELECT space_id FROM space WHERE space_name=? AND space_id<>?");
                                    $dupCheck->bind_param("si", $space_name, $space_id);
                                    $dupCheck->execute();
                                    $dupResult = $dupCheck->get_result();

                                    if ($dupResult->num_rows > 0) {
                                        $message = "<p style='font-size:20px; text-align:center;'>
                                                       YOUR RECENTLY UPDATED SPACE RECORD SEEMS TO BE A DUPLICATED. 
                                                       THEREFORE, IT HAS NOT BEEN UPDATED.
                                                    </p>";
                                    } else {
                                        $sql = "UPDATE space SET space_name=?, capacity=?, price=? WHERE space_id=?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("siii", $space_name, $capacity, $price, $space_id);
                                        $stmt->execute();
                                        $stmt->close();

                                        if ($category === "Workspace") {
                                            $conn->query("DELETE FROM room WHERE space_id=$space_id");
                                            $is_shared  = ($_POST['is_shared'] === "yes") ? 1 : 0;
                                            $has_locker = ($_POST['has_locker'] === "yes") ? 1 : 0;

                                            $check = $conn->query("SELECT space_id FROM workspace WHERE space_id=$space_id");
                                            if ($check->num_rows > 0) {
                                                $sql = "UPDATE workspace SET is_shared=?, has_locker=? WHERE space_id=?";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("iii", $is_shared, $has_locker, $space_id);
                                                $stmt->execute();
                                                $stmt->close();
                                            } else {
                                                $sql = "INSERT INTO workspace (space_id, is_shared, has_locker) VALUES (?, ?, ?)";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("iii", $space_id, $is_shared, $has_locker);
                                                $stmt->execute();
                                                $stmt->close();
                                            }
                                        }

                                        if ($category === "Room") {
                                            $conn->query("DELETE FROM workspace WHERE space_id=$space_id");
                                            $soundproof_level = $_POST['soundproofLevel'];

                                            $check = $conn->query("SELECT space_id FROM room WHERE space_id=$space_id");
                                            if ($check->num_rows > 0) {
                                                $sql = "UPDATE room SET soundproof_level=? WHERE space_id=?";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("si", $soundproof_level, $space_id);
                                                $stmt->execute();
                                                $stmt->close();
                                            } else {
                                                $sql = "INSERT INTO room (space_id, soundproof_level) VALUES (?, ?)";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bind_param("is", $space_id, $soundproof_level);
                                                $stmt->execute();
                                                $stmt->close();
                                            }
                                        }

                                        $message = "<p style='font-size:20px; text-align:center;'>
                                                       A SPACE RECORD HAS BEEN SUCCESSFULLY UPDATED
                                                    </p>";
                                    }
                                    $dupCheck->close();
                                }
                            ?>
                            <div class="gitna">
                                <?php echo $message; ?>
                            </div>
                            <div class="gitna">
                                <button class="backbackback" onclick="openSpace()">BACK</button>
                            </div>
                            <br><br>
                            <div class="grandchil6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
