<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="message.css"> 

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&family=Cherry+Bomb+One&display=swap" rel="stylesheet">
        <script>
            function readdisplayrecords(){
                window.open("readdisplayrecords.php", "_self");
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
                    <button onclick="openOverview()" class="dashboardButton">OVERVIEW</button>
                    <button onclick="openSpace()" class="dashboardButton">SPACE</button>
                    <button onclick="openRates()" class="ChosendashboardButton">RATES</button>
                    <button onclick="openReservations()" class="dashboardButton">RESERVATION</button>
                    <button onclick="openPayments()" class="dashboardButton">PAYMENTS</button>
                    <button onclick="openSettings()" class="dashboardButton">SETTINGS</button>
                </div>
            </div>
            <div class="child2">
                <div class="headerChild2">
                    <p class="headerText">.</p>
                    <div class="grandchild4">
                        <div class="grandchild5">
                            <div class="grandchil6">
                                <?php
                                    require 'db_connect.php';

                                    $sql = "TRUNCATE TABLE disp";

                                    $result = $conn->query($sql);

                                    $conn->close();
                                ?>
                                <br>
                                <div class="gitna">
                                    <p> ALL DISPLAY RECORDS HAVE BEEN SUCCESSFULLY DELETED</p>
                                </div>
                                <div class="gitna">
                                    <button class="backbackback" onclick="readdisplayrecords()">BACK</button>
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