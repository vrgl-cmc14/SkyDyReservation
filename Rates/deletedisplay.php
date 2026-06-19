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
            function readdisplayrecords(){
                window.open("readdisplayrecords.php", "_self");
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
                        <div class="grandchild5">
                            <div class="grandchil6">
                                
                                <?php
                                    require 'db_connect.php';

                                if (!isset($_GET['id'])) {
                                    $message = "<p style='font-size:20px; text-align:center;'>NO RECORD SELECTED.</p>";    
                                    exit;
                                }

                                $id = intval($_GET['id']);

                                $sql1 = "DELETE FROM disp WHERE disp_id = $id";
                                if (!$conn->query($sql1)) {
                                    $message = "<p style='font-size:20px; text-align:center;'>AN ERROR OCCURRED! " . $conn->error . "<br>";
                                } else {
                                    $message = "<p style='font-size:20px; text-align:center;'>A RECORD HAS BEEN SUCCESSFULLY DELETED</p>";
                                }

                                $conn->close();
                                ?>
                                <br>
                                <div class="gitna">
                                    <?php echo $message; ?>
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