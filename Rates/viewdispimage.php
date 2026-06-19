<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="read.css"> 

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
            function backback(){
                history.back()
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
                    <button class="ChosendashboardButton" onclick="openRates()">RATES</button>
                    <button class="dashboardButton" onclick="openReservations()">RESERVATION</button>
                    <button class="dashboardButton" onclick="openPayments()">PAYMENTS</button>
                    <button class="dashboardButton" onclick="openSettings()">SETTINGS</button>

                </div>
            </div>
            <div class="child2">
                <div class="headerChild2">
                    <p class="headerText">.</p>
                    <div class="grandchild4">
                        <div class="grandchild5">
                            <br>
                            <button onclick="backback()" class="backButton">BACK</button>
                        
                            <div class="grandchil6">
                                <br>
                                <br>
                                <div class="gitna">
                                    
                                    <?php
                                        error_reporting(E_ALL);
                                        ini_set('display_errors', 1);

                                        require 'db_connect.php';

                                        if (!isset($_GET['id'])) {
                                            die("No ID specified.");
                                        }

                                        $id = (int)$_GET['id'];

                                        $stmt = $conn->prepare("
                                            SELECT disp_name, disp_image
                                            FROM disp
                                            WHERE disp_id = ?
                                        ");
                                        $stmt->bind_param("i", $id);
                                        $stmt->execute();

                                        $result = $stmt->get_result();

                                        if ($row = $result->fetch_assoc()) {
                                            
                                            echo '<img src="data:image/jpeg;base64,' .
                                                base64_encode($row['disp_image']) .
                                                '" width="500">';
                                        } else {
                                            echo "Record not found.";
                                        }

                                        $stmt->close();
                                        $conn->close();
                                    ?>
                                    
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

