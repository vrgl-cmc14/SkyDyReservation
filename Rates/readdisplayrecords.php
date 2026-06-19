<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="recordsdis.css"> 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&family=Cherry+Bomb+One&display=swap" rel="stylesheet">
    </head>
    <script>

            function addSpace(){
                window.open("index.html", "_self");
            } 

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
            function openAdd(){
                window.open("adddisplay.html", "_self");
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
                    <button class="dashboardButton"onclick="openSpace()">SPACE</button>
                    <button class="ChosendashboardButton"onclick="openRates()">RATES</button>
                    <button class="dashboardButton"onclick="openReservations()">RESERVATION</button>
                    <button class="dashboardButton"onclick="openPayments()">PAYMENTS</button>
                    <button class="dashboardButton"onclick="openSettings()">SETTINGS</button>
                </div>
            </div>
            <div class="child2">
                <div class="headerChild2">
                    <p class="headerText">.</p>
                    <div class="grandchild4">
                        <br>
                        <div class="lagayan">
                            <button class="addRecord" onclick="openAdd()">Add a Record</button>
                            <button class="clearRecord" onclick="if(confirm('Are you sure you want to delete all records? This Cannot be Undone')) window.location.href = 'truncateDisplay.php'">Clear All</button>
                        </div>
                        <br>
                        <div class="grandchild5">
                            

                            <div class="recordsContainer">
                                <br>
                                <?php
                                    error_reporting(E_ALL);
                                    ini_set('display_errors', 1);

                                    require 'db_connect.php';

                                    $result = $conn->query("SELECT disp_id, disp_name FROM disp");

                                    if ($result && $result->num_rows > 0) {
                                        echo "<div style='display: flex; width: 100%; font-size: 13px'>";
                                        echo "<div style='flex: 1; display: flex; justify-content: center; align-items: center;'>";
                                        echo "<p style=' text-align: center; font-size: 12px'>DISPLAY NAME</p>";
                                        echo "</div>";
                                        echo "<div style='flex: 1; display: flex; justify-content: center; align-items: center;'>";
                                        echo "<p style=' text-align: center; font-size: 12px'>DETAILS</p>";
                                        echo "</div>";
                                        echo "<div style='flex: 1; display: flex; justify-content: center; align-items: center;'>";
                                        echo "<p style=' text-align: center; font-size: 12px'>DELETE</p>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "<hr>";

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<div class='recordCard'>";
                                            echo "<div style='flex: 1; display: flex; justify-content: center; align-items: center;'>";
                                            echo "<p class='recordName' style=' text-align: center; font-size: 12px'>" . htmlspecialchars($row['disp_name']) . "</p>";
                                            echo "</div>";
                                            echo "<div style='flex: 1; display: flex; justify-content: center; align-items: center;'>";
                                            echo "<button style=' text-align: center; font-size: 12px' class='editRecord' onclick=\"location.href='viewdisplaydetails.php?id=" . htmlspecialchars($row['disp_id']) . "'\">VIEW</button>";
                                            echo "</div>";
                                            echo "<div style='flex: 1; display: flex; justify-content: center; align-items: center;'>";
                                            echo "<button style=' text-align: center; font-size: 12px' class='deleteRecord' onclick=\"if(confirm('Are you sure you want to delete this record? This Cannot be Undone')) location.href='deletedisplay.php?id=" . htmlspecialchars($row['disp_id']) . "'\">DELETE</button>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<hr>";
                                        }
                                    } else {
                                        echo "<p style='text-align: center'>No records found.</p>";
                                    }
                                ?>
                                <br>
                                <br>
                            </div>
                            <div class="grandchil6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>