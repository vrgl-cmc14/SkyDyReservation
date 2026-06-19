<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="message.css"> 
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
                window.open("displayrecentreservation.php", "_self")
            }
            function openFuture(){
                window.open("displayfuturereservation.php", "_self")
            }
            function backbackback(){
                window.open("settings.html", "_self")
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
                    <button class="dashboardButton" onclick="openSpace()">SPACE</button>
                    <button class="dashboardButton" onclick="openRates()">RATES</button>
                    <button class="dashboardButton" onclick="openReservations()">RESERVATION</button>
                    <button class="dashboardButton" onclick="openPayments()">PAYMENTS</button>
                    <button class="ChosendashboardButton" onclick="openSettings()">SETTINGS</button>
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

                                    $sql = "TRUNCATE TABLE customer";

                                    $result = $conn->query($sql);

                                    $conn->close();

                                ?>
                                <br>
                                <div class="gitna">
                                    <p style='font-size:20px; text-align:center;'> ALL CUSTOMER RECORDS HAVE BEEN SUCCESSFULLY DELETED</p>
                                </div>
                                <div class="gitna">
                                    <button class="backbackback" onclick="backbackback()">BACK</button>
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

