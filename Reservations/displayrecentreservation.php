<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="rsvpdes.css"> 
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
            function openToday(){
                window.open("reservation.html", "_self")
            }
        </script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&family=Cherry+Bomb+One&display=swap" rel="stylesheet">
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
                    <button class="dashboardButton" onclick="openSpace()">SPACE</button>
                    <button class="dashboardButton" onclick="openRates()">RATES</button>
                    <button class="ChosendashboardButton" onclick="openReservations()">RESERVATION</button>
                    <button class="dashboardButton" onclick="openPayments()">PAYMENTS</button>
                    <button class="dashboardButton" onclick="openSettings()">SETTINGS</button>
                </div>
            </div>
            <div class="child2">
                <div class="headerChild2">
                    <p class="headerText">.</p>
                    <div class="grandchild4">
                        <br>
                        <div class="mgaButton">
                            <button class="add" onclick="openToday()">TODAY</button>
                            <button class="chosenone" onclick="openRecent()"> RECENT</button>
                            <button class="add" onclick="openFuture()"> FUTURE</button>
                        </div>
                        <br>
                        <hr>

                        <div class="searchFlex">
                            <div class="search1">
                                <form action="rsvpsearchbydate.php" method="get">
                                    <input class="datafieldText" type="date" name="date" required>
                                    <input class="search" type="submit" value="Search by Date" id="sbydate" name="sbydate"> 
                                </form>
                            </div>
                            <div class="search2">
                                <form action="rsvpsearchbyid.php" method="get">
                                    <input class="datafieldText" type="number" placeholder="Enter a number" name="rsvpId" required min="0"> 
                                    <input class="search" type="submit" value="Search by ID">
                                </form>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <?php
                                    require 'db_connect.php';

                                    $sql = "SELECT r.*, s.space_name 
                                            FROM reservation r
                                            JOIN space s ON r.space_id = s.space_id
                                            WHERE DATE(r.reservation_date) < CURDATE()
                                            ORDER BY r.reservation_date DESC"; 

                                    $result = $conn->query($sql);
                                    echo "<br>";
                                    echo "<h2 style='text-align:center; letter-spacing:2px'> PAST RESERVATIONS  </h2>";
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
                                            echo "<p style='margin-top:20px; font-weight:bold; text-transform: uppercase'>$status Reservations</p>";

                                            if (count($rows) > 0) {
                                                echo "<div style='display:flex; flex-direction:row; padding:4px;'>";
                                                echo "<div style='flex:1; text-align:center; font-size:13px'><strong>RESERVATION ID</strong></div>";
                                                echo "<div style='flex:1; text-align:center; font-size:13px'><strong>SPACE NAME</strong></div>";
                                                echo "<div style='flex:1; text-align:center; font-size:13px'><strong>STATUS</strong></div>";
                                                echo "<div style='flex:1; text-align:center; font-size:13px'><strong>DATE</strong></div>";
                                                echo "<div style='flex:1; text-align:center; font-size:13px'><strong>TIME</strong></div>";
                                                echo "<div style='flex:1; text-align:center; font-size:13px'><strong>TIMEOUT</strong></div>";
                                                echo "<div style='flex:1; text-align:center; font-size:13px'><strong>DETAILS</strong></div>";
                                                echo "</div><hr>";

                                                foreach ($rows as $row) {
                                                    echo "<div style='display:flex; flex-direction:row; padding:4px'>";
                                                    echo "<div style='flex:1; text-align:center; font-size:12px'>" . ($row['reservation_id'] ?? '-') . "</div>";
                                                    echo "<div style='flex:1; text-align:center; font-size:12px'>" . ($row['space_name'] ?? '-') . "</div>";
                                                    echo "<div style='flex:1; text-align:center; font-size:12px'>" . ($row['reservation_status'] ?? '-') . "</div>";
                                                    echo "<div style='flex:1; text-align:center; font-size:12px'>" . ($row['reservation_date'] ?? '-') . "</div>";
                                                    echo "<div style='flex:1; text-align:center; font-size:12px'>" . ($row['reservation_time'] ?? '-') . "</div>";
                                                    echo "<div style='flex:1; text-align:center; font-size:12px'>" . ($row['expected_timeout'] ?? '-') . "</div>";
                                                    echo "<div style='flex:1; text-align:center;'><button class='editRecord' onclick=\"location.href='viewrsvpdetails.php?id=" . $row['reservation_id'] . "'\"> VIEW </button></div>";
                                                    echo "</div><hr>";
                                                }
                                                echo"<br>";
                                            } else {
                                                echo "<p>No $status past reservations found.</p>";
                                                echo "<br>";
                                            }
                                        }

                                    } else {
                                        echo "<p class='noRes'>No past reservations found</p>";

                                    }

                                    $conn->close();
                                    ?>

                        <div class="grandchild5">
                            <div class="grandchil6">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>