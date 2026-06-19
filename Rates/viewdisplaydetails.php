<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="read.css"> 
        <script>
            function editdis(){
                window.open("updatedisplay.php", "_self");
            }
        </script>

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
                    <button class="dashboardButton"onclick="openOverview()">OVERVIEW</button>
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
                            <br>
                            <button onclick="backback()" class="backButton">BACK</button>

                            <h1 style="text-align: center">DETAILS</h1>
                            <br>
                            <?php
                                require 'db_connect.php';

                                $id = intval($_GET['id']);
                                $sql = "SELECT * FROM disp WHERE disp_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                            ?>
                                <div style="display:flex; width:100%;">
                                    <div style="flex:1; font-size: 12px; text-align: center" ><p>DISPLAY NAME</p></div>
                                    <div style="flex:1; font-size: 12px; text-align: center"><p>RENTAL TYPE</p></div>
                                    <div style="flex:1; font-size: 12px; text-align: center"><p>PRICE</p></div>
                                </div>
                                <hr>

                                <div style="display:flex; width:100%;">
                                    <div style="flex:1; font-size: 12px; text-align: center"><p><?= htmlspecialchars($row['disp_name']) ?></p></div>
                                    <div style="flex:1; font-size: 12px; text-align: center"><p><?= htmlspecialchars($row['disp_rentCat']) ?></p></div>
                                    <div style="flex:1; font-size: 12px; text-align: center"><p><?= htmlspecialchars($row['disp_price']) ?></p></div>
                                </div>
                                <hr>
                                <br>
                                <br>
                                <div style="display:flex; width:100%;">
                                    <div style="flex:1; display: flex; justify-content: center; align-items: center">
                                        <button class="backbackback" onclick="location.href='viewdispimage.php?id=<?= $row['disp_id'] ?>'"> VIEW IMAGE </button>
                                    </div>
                                    <div style="flex:1; display: flex; justify-content: center; align-items: center">
                                        <button class="backbackback" onclick="location.href='updatedisplay.php?id=<?= $row['disp_id'] ?>'"> EDIT DETAILS </button>
                                     </div>
                                </div>
                                <br>
                                <br>

                            <?php
                                $stmt->close();
                                $conn->close();
                            ?>
                            <br>
                            <div class="grandchil6">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>