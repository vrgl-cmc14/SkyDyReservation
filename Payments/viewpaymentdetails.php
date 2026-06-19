<?php
require 'db_connect.php';

$payment_id = $_GET['id'] ?? null;
$reservation_id = null;

function displayVal($val) {
    return ($val === null || $val === '') ? '-' : htmlspecialchars($val);
}

if ($payment_id) {
    $sql = "SELECT reservation_id FROM payment WHERE payment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $payment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $reservation_id = $row['reservation_id'];
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="payment.css"> 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&family=Cherry+Bomb+One&display=swap" rel="stylesheet">
    </head>
    <script>
        function goesBack(){
            history.back()
            }
            
            function openOverview(){
                window.open("../Admin/iindex.php", "_self");
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
                    <button class="dashboardButton"onclick="openRates()">RATES</button>
                    <button class="dashboardButton"onclick="openReservations()">RESERVATION</button>
                    <button class="ChosendashboardButton"onclick="openPayments()">PAYMENTS</button>
                    <button class="dashboardButton"onclick="openSettings()">SETTINGS</button>
                </div>
            </div>
            <div class="child2">
                <div class="headerChild2">
                    <p class="headerText">.</p>
                    <div class="grandchild4">
                        <div class="grandchild5">
                            <div class="parent1">
                                <div class="col1">
                                    <button class="backback" onclick="goesBack()">BACK</button>
                                </div>
                                <div class="col2"></div>
                                <div class="col3"></div>
                                <div class="col4">
                                    <button class="editrsvp" onclick="location.href='../Reservations/viewrsvpdetails.php?id=<?php echo htmlspecialchars($reservation_id); ?>'">EDIT RESERVATION STATUS</button>
                                </div>
                            </div>
                            <div class="grandchil6">
                                <br><br>
                                <?php
                                if ($payment_id) {
                                    $sql = "SELECT * FROM payment WHERE payment_id = ?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("i", $payment_id);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        $payment = $result->fetch_assoc();

                                        echo "<br> <br> <h3>PAYMENT DETAILS</h3>";
                                        echo "<div style='display: flex'>
                                                <div style='flex: 1; text-align:center;font-size:12px'> PAYMENT ID </div>
                                                <div style='flex: 1; text-align:center;font-size:12px'> RESERVATION ID </div>
                                                <div style='flex: 1; text-align:center;font-size:12px'> REFERENCE CODE </div>
                                                <div style='flex: 1; text-align:center;font-size:12px'> PAYMENT MODE </div>
                                                <div style='flex: 1; text-align:center;font-size:12px'> AMOUNT PAID </div>
                                                <div style='flex: 1; text-align:center;font-size:12px'> DATE / TIME </div>
                                              </div>  
                                              <hr>
                                        ";

                                        echo "<div style='display: flex'>
                                                <div style='flex: 1; text-align:center;font-size:12px'> " . displayVal($payment['payment_id']) . " </div>
                                                <div style='flex: 1; text-align:center;font-size:12px'> " . displayVal($reservation_id) . " </div>
                                                <div style='flex: 1; text-align:center;font-size:12px'> " . displayVal($payment['reference_code']) . " </div>
                                                <div style='flex: 1; text-align:center;font-size:12px'> " . displayVal($payment['payment_mode']) . " </div>
                                                <div style='flex: 1; text-align:center;font-size:12px'> " . displayVal($payment['amount_paid']) . " </div>
                                                <div style='flex: 1; text-align:center;font-size:12px'> " . displayVal($payment['payment_date_time']) . " </div>
                                            </div>
                                            <hr>
                                            <br>
                                            <br>
                                            <br>
                                        ";


                                        echo "<h3>RESERVATION RECORD</h3>";

                                        $sqlRes = "SELECT * FROM reservation WHERE reservation_id = ?";
                                        $stmtRes = $conn->prepare($sqlRes);
                                        $stmtRes->bind_param("i", $reservation_id);
                                        $stmtRes->execute();
                                        $resResult = $stmtRes->get_result();

                                        if ($resResult->num_rows > 0) {
                                            $reservation = $resResult->fetch_assoc();

                                            echo "<div style='display:flex;flex-direction:row;gap:0;padding:4px;'>";
                                            foreach ($reservation as $col => $val) {
                                                echo "<div style='flex:1;text-align:center;font-size:12px'><strong>" . strtoupper($col) . "</strong></div>";
                                            }
                                            echo "</div><hr>";

                                            echo "<div style='display:flex;flex-direction:row;gap:0;padding:4px;'>";
                                            foreach ($reservation as $col => $val) {
                                                echo "<div style='flex:1;text-align:center;font-size:12px'>" . displayVal($val) . "</div>";
                                            }
                                            echo "</div><hr>";
                                        } else {
                                            echo "<p>No reservation record found for ID $reservation_id</p>";
                                        }
                                    } else {
                                        echo "<p>No payment found with ID $payment_id</p>";
                                    }
                                } else {
                                    echo "<p>No payment ID provided.</p>";
                                }

                                $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>