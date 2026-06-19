<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css"> 

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
                    <button class="ChosendashboardButton"onclick="openSpace()">SPACE</button>
                    <button class="dashboardButton"onclick="openRates()">RATES</button>
                    <button class="dashboardButton"onclick="openReservations()">RESERVATION</button>
                    <button class="dashboardButton"onclick="openPayments()">PAYMENTS</button>
                    <button class="dashboardButton"onclick="openSettings()">SETTINGS</button>
                </div>
            </div>
            <div class="child2">
                <div class="headerChild2">
                    <p class="headerText" style="color: #3B71CA">.</p>
                    <div class="grandchild4">
                        <div class="grandchild5">
                            <div class="grandchil6">
                                <?php
                                    require 'db_connect.php';


                                    $message = "";
                                    $sql1 = "
                                    DELETE FROM workspace
                                    WHERE NOT EXISTS (
                                        SELECT 1 FROM reservation r WHERE r.space_id = workspace.space_id
                                    )";
                                    if ($conn->query($sql1) === TRUE) {
                                        #echo "";
                                    } else {
                                        $message = "<p style='font-size:20px; text-align:center;'> AN ERROR OCCURED: " . $conn->error . "</p>";
                                    }

                                    $sql2 = "
                                    DELETE FROM room
                                    WHERE NOT EXISTS (
                                        SELECT 1 FROM reservation r WHERE r.space_id = room.space_id
                                    )";
                                    if ($conn->query($sql2) === TRUE) {
                                        
                                    } else {
                                        $message = "<p style='font-size:20px; text-align:center;'> AN ERROR OCCURED: " . $conn->error . "</p>";
                                    }

                                    $sql3 = "
                                    DELETE FROM space
                                    WHERE NOT EXISTS (
                                        SELECT 1 FROM reservation r WHERE r.space_id = space.space_id
                                    )";
                                    if ($conn->query($sql3) === TRUE) {
                                        $message = "<p style='font-size:20px; text-align:center;'> UNREFERENCED SPACES HAVE BEEN DELETED.
                                        SPACES LINKED TO RESERVATIONS CANNOT BE DELETED.
                                        TO REMOVE THEM, FIRST DELETE ALL RESERVATION RECORDS UNDER SETTINGS </p>";
                                    } else {
                                        $message =  "<p style='font-size:20px; text-align:center;'> AN ERROR OCCURRED: " . $conn->error . "<br>";
                                    }

                                    $conn->close();
                                    ?>
                                    <br>
                                    <div class="gitna">
                                        <?php echo $message; ?>
                                    </div>
                                    <div class="gitna">
                                        <button onclick="openSpace()" class="backbackback">BACK</button>
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

