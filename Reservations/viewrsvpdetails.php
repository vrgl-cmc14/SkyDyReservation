<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="rsvpdes.css"> 
        <script>
            function goesBack(){
                history.back();
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
            function openRecent(){
                window.open("displayrecentreservation.php", "_self")
            }
            function openFuture(){
                window.open("displayfuturereservation.php", "_self")
            }
            function openToday(){
                window.open("reservation.html", "_self")
            }

            function editStatus(){
                var container = document.getElementById("status");
                var btn = document.querySelector(".editStatus");

                if (container.innerHTML.trim() !== "") {
                    container.innerHTML = "";
                    btn.textContent = "EDIT RESERVATION STATUS";
                    return;
                }

                btn.textContent = "CANCEL EDITING STATUS";

                var br = document.createElement("br");
                var br2 = document.createElement("br");
                var br3 = document.createElement("br");
                var br4 = document.createElement("br");

                var container1 = document.createElement("div");
                container1.setAttribute("class", "container1");

                var container2 = document.createElement("div");
                container2.setAttribute("class","container2");

                var container3 = document.createElement("div");
                container3.setAttribute("class","container3");

                var r1 = document.createElement("input");
                r1.setAttribute("type", "radio");
                r1.setAttribute("name", "statusrsvp");
                r1.setAttribute("id", "confirmed");
                r1.setAttribute("value", "Confirmed");
                r1.required = true;

                var r2 = document.createElement("input");
                r2.setAttribute("type", "radio");
                r2.setAttribute("name", "statusrsvp");
                r2.setAttribute("id", "pending");
                r2.setAttribute("value", "Pending");

                var r3 = document.createElement("input");
                r3.setAttribute("type", "radio");
                r3.setAttribute("name", "statusrsvp");
                r3.setAttribute("id", "cancelled");
                r3.setAttribute("value", "Cancelled");

                var l1 = document.createElement("label");
                l1.setAttribute("for", "confirmed");
                l1.textContent = "  Confirmed";

                var l2 = document.createElement("label");
                l2.setAttribute("for", "pending");
                l2.textContent = "  Pending";

                var l3 = document.createElement("label");
                l3.setAttribute("for", "cancelled");
                l3.textContent = "  Cancelled";

                var submit = document.createElement("input");
                submit.setAttribute("type", "submit");
                submit.setAttribute("value", "SUBMIT");
                submit.setAttribute("class", "subButton");

                container1.append(r1, l1);
                container2.append(r2, l2);
                container3.append(r3, l3);

                var hr = document.createElement("hr");
                var br3 = document.createElement("br");

                var wrapper = document.createElement("div");
                wrapper.style.display = "flex";
                wrapper.style.flexDirection = "row";
                wrapper.style.alignItems = "center";
                wrapper.style.justifyContent = "center";
                wrapper.style.width = "100%";
                wrapper.style.gap = "10%";

                container.append(br);
                container.append(br2);

                wrapper.append(container1, container2, container3, submit);
                container.append(wrapper);
                container.append(br3);
                container.append(hr);
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
                        <div class="grandchild5">
                            <button class="backback" onclick="goesBack()"> BACK</button>
                            
                            <div class="edit">
                                <br>
                                <br>
                                <hr>
                                <button class="editStatus" onclick="editStatus()"> EDIT RESERVATION STATUS </button>
                                <form id="status" style="width:100%;" method="POST" action="updatersvpstatus.php?id=<?php echo htmlspecialchars($_GET['id'] ?? ''); ?>">
                            </form>
                            </div>
                            <div class="grandchil6">
                                <?php
                                    require 'db_connect.php';

                                    $reservation_id = $_GET['id'] ?? null;

                                    if ($reservation_id) {
                                        $sql = "SELECT r.*, s.space_name,
                                                    c.customer_id, c.first_name, c.middle_name, c.last_name, c.suffix, c.gender,
                                                    c.email_address, c.phone_number
                                                FROM reservation r
                                                JOIN space s ON r.space_id = s.space_id
                                                LEFT JOIN customer c ON r.reservation_id = c.reservation_id
                                                WHERE r.reservation_id = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("i", $reservation_id);
                                        $stmt->execute();
                                        $reservationResult = $stmt->get_result();

                                        if ($reservationResult->num_rows > 0) {
                                            $res = $reservationResult->fetch_assoc();

                                            echo "<br>";
                                            echo "<br>";

                                            echo "<p style='margin-top:20px; font-weight:bold;'> RESERVATION DETAILS </p>";
                                            echo "<div style='display:flex; flex-direction:row; gap:0; margin-top:15px; margin-bottom:0; padding:4px;'>";
                                            echo "<div style='flex:1; text-align:center; font-size:13px'><strong>RESERVATION ID</strong></div>";
                                            echo "<div style='flex:1; text-align:center; font-size:13px'><strong>SPACE</strong></div>";
                                            echo "<div style='flex:1; text-align:center; font-size:13px'><strong>STATUS</strong></div>";
                                            echo "<div style='flex:1; text-align:center; font-size:13px'><strong>DATE</strong></div>";
                                            echo "<div style='flex:1; text-align:center; font-size:13px'><strong>TIME</strong></div>";
                                            echo "<div style='flex:1; text-align:center; font-size:13px'><strong>EXPECTED TIMEOUT</strong></div>";
                                            echo "</div><hr>";

                                            echo "<div style='display:flex; flex-direction:row; gap:0; margin-bottom:0; padding:4px'>";
                                            echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($res['reservation_id']) . "</div>";
                                            echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($res['space_name']) . "</div>";
                                            echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($res['reservation_status']) . "</div>";
                                            echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($res['reservation_date']) . "</div>";
                                            echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($res['reservation_time']) . "</div>";
                                            echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($res['expected_timeout']) . "</div>";
                                            echo "</div><hr>";

                                            echo "<br>";
                                            echo "<br>";

                                            echo "<p style='margin-top:20px; font-weight:bold;'>CUSTOMER INFORMATION</p>";
                                            echo "<div style='display:flex; flex-direction:row; gap:0; margin-top:15px; margin-bottom:0; padding:4px;'>";
                                            echo "<div style='flex:1; text-align:center; font-size:13px'><strong>CUSTOMER ID</strong></div>";
                                            echo "<div style='flex:1; text-align:center; font-size:13px'><strong>NAME</strong></div>";
                                            echo "<div style='flex:1; text-align:center; font-size:13px'><strong>GENDER</strong></div>";
                                            echo "<div style='flex:1; text-align:center; font-size:13px'><strong>EMAIL</strong></div>";
                                            echo "<div style='flex:1; text-align:center; font-size:13px'><strong>PHONE NUMBER</strong></div>";
                                            echo "</div><hr>";

                                            echo "<div style='display:flex; flex-direction:row; gap:0; margin-bottom:0; padding:4px'>";
                                            echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($res['customer_id']) . "</div>";
                                            $fullName = $res['first_name'] . " " . ($res['middle_name'] ? $res['middle_name']." " : "") . $res['last_name'] . " " . $res['suffix'];
                                            echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars(trim($fullName)) . "</div>";
                                            echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($res['gender']) . "</div>";
                                            echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($res['email_address']) . "</div>";
                                            echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($res['phone_number']) . "</div>";
                                            echo "</div><hr>";

                                            echo "<br>";
                                            echo "<br>";
                                            echo "<p style='margin-top:20px; font-weight:bold;'>PAYMENT INFORMATION</p>";
                                            $sqlPayments = "SELECT payment_id, reference_code, amount_paid, payment_mode, payment_date_time 
                                                            FROM payment 
                                                            WHERE reservation_id = ?";
                                            $stmtPayments = $conn->prepare($sqlPayments);
                                            $stmtPayments->bind_param("i", $reservation_id);
                                            $stmtPayments->execute();
                                            $paymentResult = $stmtPayments->get_result();

                                            if ($paymentResult->num_rows > 0) {
                                                echo "<div style='display:flex; flex-direction:row; gap:0; margin-top:15px; margin-bottom:0; padding:4px;'>";
                                                echo "<div style='flex:1; text-align:center; font-size:13px'><strong>PAYMENT ID</strong></div>";
                                                echo "<div style='flex:1; text-align:center; font-size:13px'><strong>REFERENCE CODE</strong></div>";
                                                echo "<div style='flex:1; text-align:center; font-size:13px'><strong>AMOUNT PAID</strong></div>";
                                                echo "<div style='flex:1; text-align:center; font-size:13px'><strong>MODE</strong></div>";
                                                echo "<div style='flex:1; text-align:center; font-size:13px'><strong>DATE/TIME</strong></div>";
                                                echo "</div><hr>";

                                                while ($pay = $paymentResult->fetch_assoc()) {
                                                    echo "<div style='display:flex; flex-direction:row; gap:0; margin-bottom:0; padding:4px'>";
                                                    echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($pay['payment_id']) . "</div>";
                                                    echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($pay['reference_code']) . "</div>";
                                                    echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($pay['amount_paid']) . "</div>";
                                                    echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($pay['payment_mode']) . "</div>";
                                                    echo "<div style='flex:1; text-align:center; font-size:12px'>" . htmlspecialchars($pay['payment_date_time']) . "</div>";
                                                    echo "</div><hr>";
                                                }
                                            } else {
                                                echo "<p>No payment records found.</p>";
                                            }
                                        } else {
                                            echo "<p>No reservation found with ID $reservation_id</p>";
                                        }
                                    } else {
                                        echo "<p>Invalid reservation ID.</p>";
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