<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="payment.css"> 
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
                window.open("viewrecentpayments.php", "_self");
            }
            function openToday(){
                window.open("payments.html", "_self");
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
                    <button class="dashboardButton" onclick="openSpace()">SPACE</button>
                    <button class="dashboardButton" onclick="openRates()">RATES</button>
                    <button class="dashboardButton" onclick="openReservations()">RESERVATION</button>
                    <button class="ChosendashboardButton" onclick="openPayments()">PAYMENTS</button>
                    <button class="dashboardButton" onclick="openSettings()">SETTINGS</button>
                </div>
            </div>
            <div class="child2">
                <div class="headerChild2">
                    <p class="headerText">.</p>
                    <div class="grandchild4">
                        <br>
                        <div class="mgaButton">
                            <button class="add" onclick="openToday()" >TODAY</button>
                            <button class="chosenone" onclick="openRecent()"> RECENT</button>
                        </div>
                        <br>
                        <hr>

                        <div class="searchFlex">
                            <div class="search1">
                                <form action="paysearchbydate.php" method="get">
                                    <input class="datafieldText" type="date" name="date" required>
                                    <input class="search" type="submit" value="Search by Date" id="sbydate" name="sbydate"> 
                                </form>
                            </div>
                            <div class="search2">
                                <form action="paysearchbyid.php" method="get">
                                    <input class="datafieldText" type="number" placeholder="Enter a number" name="payId" required min="0"> 
                                    <input class="search" type="submit" value="Search by ID">
                                </form>
                            </div>
                        </div>
                        <br>
                        <hr>

                        <?php
                            require 'db_connect.php';

                            $sql = "SELECT *
                                    FROM payment
                                    WHERE DATE(CONVERT_TZ(payment_date_time, '+00:00', '+00:00')) < CURDATE()
                                    ORDER BY payment_date_time DESC";

                            $result = $conn->query($sql);

                            echo "<br>";
                            echo "<h2 style='text-align:center; letter-spacing:2px  '> RECENT RESERVATION INCOME </h2>";
                            echo "<br>";

                            if ($result->num_rows > 0) {
                                echo "<div style='display: flex; flex-direction: row; gap: 0; margin-top: 15px; margin-bottom: 0; padding: 4px;'>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>PAYMENT ID</strong></div>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>RESERVATION ID</strong></div>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>REFERENCE CODE</strong></div>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>PAYMENT MODE</strong></div>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>AMOUNT PAID</strong></div>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>PAYMENT DATE-TIME</strong></div>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 13px'><strong>DETAILS</strong></div>";
                                echo "</div>";
                                echo "<hr>";
                                
                                while($row = $result->fetch_assoc()) {
                                echo "<div style='display: flex; flex-direction: row; gap: 0; margin-bottom: 0; padding: 4px'>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['payment_id']) . "</div>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['reservation_id']) . "</div>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['reference_code']) . "</div>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['payment_mode']) . "</div>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['amount_paid']) . "</div>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center; font-size: 12px'>" . htmlspecialchars($row['payment_date_time']) . "</div>";
                                echo "<div style='flex: 1; padding: 5px; text-align: center;'><button class='editRecord' onclick=\"location.href='viewpaymentdetails.php?id=" . $row['payment_id'] . "'\"> VIEW </button></div>";
                                echo "</div>";
                                echo "<hr>";
                            }


                                echo "</div>";

                            } else {
                                echo "<p class='noRes'>Lorem Ipsum</h1>";
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
