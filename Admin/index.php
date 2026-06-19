<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="dashboardDesign.css"> 
        

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chelsea+Market&family=Cherry+Bomb+One&display=swap" rel="stylesheet">
        <script>
            function logout(){
                window.open("../AdminLogin/index.html", "_self")
            }
            function openSpace(){
                window.open("../Space/spaceoverview.html", "_self")
            }
            function openRates(){
                window.open("../rates/readdisplayrecords.php", "_self")
            }
            function openReservations(){
                window.open("../reservations/reservation.html", "_self")
            }
            function openPayments(){
                window.open("../payments/payments.html", "_self")
            }
            function openSettings(){
                window.open("../settings/settings.html", "_self")
            }
            function openOverview(){
                window.open("../admin/index.php", "_self")
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
                    <button class="ChosendashboardButton">OVERVIEW</button>
                    <button class="dashboardButton" onclick="openSpace()">SPACE</button>
                    <button class="dashboardButton" onclick="openRates()">RATES</button>
                    <button class="dashboardButton" onclick="openReservations()">RESERVATION</button>
                    <button class="dashboardButton" onclick="openPayments()">PAYMENTS</button>
                    <button class="dashboardButton" onclick="openSettings()">SETTINGS</button>
                </div>
            </div>
            <div class="child2">
                <div class="headerChild2">
                    <p class="headerText">.</p>
                    <div class="grandchild4">
                        <div class="logoutcontainer">
                            <button onclick="logout()" class="backbackback">LOG OUT</button>
                        </div>
                        <div class="grandchild5">
                            
                            <div class="container">
                                
                                <div class="sum1">
                                    <p class="text1"> TOTAL <br>RESERVATIONS </p>
                                    <?php
                                        require 'db_connect.php';

                                        $sql = "SELECT count(reservation_id) AS total_reservations FROM reservation";

                                        $result = $conn->query($sql);
                                        $message = "";

                                        if ($result->num_rows > 0){
                                            $row = $result->fetch_assoc();
                                            $message = "<h1 style='text-align: center; color: whitesmoke'>" . $row['total_reservations'] . "</h1>";
                                        
                                        } else {
                                           $message = "No records found";
                                        }

                                        echo $message;
                                        $conn->close();     
                                    ?>

                                </div>
                                <div class="sum1">
                                    <p class="text1"> TODAY'S <br>RESERVATIONS</p>
                                    <?php
                                        require 'db_connect.php';

                                        $sql = "SELECT count(reservation_id) AS total_reservations FROM reservation WHERE reservation_status = 'Confirmed' AND reservation_date = CURDATE()";

                                        $result = $conn->query($sql);
                                        $message = "";

                                        if ($result->num_rows > 0){
                                            $row = $result->fetch_assoc();
                                            $message = "<h1 style='text-align: center; color: whitesmoke'>" . $row['total_reservations'] . "</h1>";
                                        
                                        } else {
                                           $message = "No records found";
                                        }

                                        echo $message;
                                        $conn->close();     
                                    ?>
                                </div>
                                <div class="sum1">
                                    <p class="text1"> CONFIRMED <br>RESERVATIONS </p>
                                    <?php
                                        require 'db_connect.php';

                                        $sql = "SELECT count(reservation_id) AS total_reservations FROM reservation WHERE reservation_status = 'Confirmed'";

                                        $result = $conn->query($sql);
                                        $message = "";

                                        if ($result->num_rows > 0){
                                            $row = $result->fetch_assoc();
                                            $message = "<h1 style='text-align: center; color: whitesmoke'>" . $row['total_reservations'] . "</h1>";
                                        
                                        } else {
                                           $message = "No records found";
                                        }

                                        echo $message;
                                        $conn->close();     
                                    ?>
                                </div>
                                <div class="sum1">
                                    <p class="text1">PENDING <br>RESERVATIONS</p>
                                    <?php
                                        require 'db_connect.php';

                                        $sql = "SELECT count(reservation_id) AS total_reservations FROM reservation WHERE reservation_status = 'Pending'";

                                        $result = $conn->query($sql);
                                        $message = "";

                                        if ($result->num_rows > 0){
                                            $row = $result->fetch_assoc();
                                            $message = "<h1 style='text-align: center; color: whitesmoke'>" . $row['total_reservations'] . "</h1>";
                                        
                                        } else {
                                           $message = "No records found";
                                        }

                                        echo $message;
                                        $conn->close();     
                                    ?>
                                    

                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <div class="container2">
                                <div class="sum2">
                                    <div class="s2r1">
                                        <h3 class="graphTitle">RESERVATIONS OVER THE LAST 7 DAYS</h3>
                                    </div>
                                    <div class="s2r2">
                                    <?php
                                        require 'db_connect.php';

                                        $sql = "SELECT d.reservation_date,
                                                    COALESCE(COUNT(r.reservation_id), 0) AS total_reservations
                                                FROM (
                                                    SELECT CURDATE() - INTERVAL n DAY AS reservation_date
                                                    FROM (
                                                        SELECT 0 AS n UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 
                                                        UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
                                                    ) AS nums
                                                ) AS d
                                                LEFT JOIN reservation r 
                                                    ON r.reservation_date = d.reservation_date
                                                GROUP BY d.reservation_date
                                                ORDER BY d.reservation_date ASC";

                                        $result = $conn->query($sql);

                                        $dates = [];
                                        $counts = [];

                                        while($row = $result->fetch_assoc()) {
                                            $dates[] = $row['reservation_date'];
                                            $counts[] = $row['total_reservations'];
                                        }

                                        $conn->close();
                                    ?>

                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                    <canvas id="reservationsChart"></canvas>

                                    <script>
                                    const ctx = document.getElementById('reservationsChart').getContext('2d');
                                    const reservationsChart = new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: <?php echo json_encode($dates); ?>,
                                            datasets: [{
                                                data: <?php echo json_encode($counts); ?>,
                                                borderColor: 'black',
                                                fill: true,
                                                pointRadius: 5,
                                                pointBackgroundColor: 'BLACK',
                                                pointBorderColor: 'black'
                                            }]
                                        },
                                        options: {
                                            responsive: false,
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    title: { display: true, text: 'Number of Reservations' }
                                                },
                                                x: {
                                                    title: { display: true, text: 'Date' }
                                                }
                                            },
                                            plugins: {
                                                legend: {
                                                    labels: {
                                                        color: 'black',
                                                        font: {size: 14}
                                                    },
                                                    display: false
                                                }
                                            }
                                        }
                                    });
                                    </script>
                                    </div>

                                    
                                </div>
                                <div class="sum3">
                                    <div class="row1">
                                        <div class="r1c1">
                                            <p class="rowText">AVAILABLE WORKSPACES: </p>
                                        </div>
                                        <div class="r1c2">
                                            <?php
                                                require 'db_connect.php';

                                                $sql = "SELECT 
                                                            (SELECT COUNT(space_id) FROM workspace) 
                                                            - 
                                                            (SELECT COUNT(DISTINCT r.space_id)
                                                            FROM reservation r
                                                            JOIN workspace w ON r.space_id = w.space_id
                                                            WHERE r.reservation_status = 'Confirmed'
                                                            AND r.reservation_date = CURDATE()
                                                            ) AS available_workspaces";

                                                $result = $conn->query($sql);
                                                $row = $result->fetch_assoc();
                                                $message = "<p style='text-align: center; font-size: 30px; font-weight: bold;'>" . $row["available_workspaces"] . "</p>";

                                                echo $message;

                                            ?>

                                        </div>
                                        
                                    </div>
                                    <br>
                                    <div class="row2">
                                        <div class="r2c1">
                                            <p class="rowText">AVAILABLE ROOMS: </p>
                                        </div>
                                        <div class="r2c2">
                                            <?php
                                                require 'db_connect.php';

                                                $sql = "SELECT 
                                                    (SELECT COUNT(space_id) FROM room) 
                                                    - 
                                                    (SELECT COUNT(DISTINCT r.space_id)
                                                    FROM reservation r
                                                    JOIN room ro ON r.space_id = ro.space_id
                                                    WHERE r.reservation_status = 'Confirmed'
                                                    AND r.reservation_date = CURDATE()
                                                    AND r.reservation_time <= CURTIME()
                                                    AND r.expected_timeout >= CURTIME()
                                                    ) AS available_rooms";

                                                $result = $conn->query($sql);
                                                $row = $result->fetch_assoc();
                                                $message = "<p style='text-align: center; font-size: 30px; font-weight: bold'>" . $row["available_rooms"] . "</p>";

                                                echo $message;
                                            ?>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row3">
                                        <div class="r3c1">
                                            <p class="rowText">OCCUPIED WORKSPACES: </p>
                                        </div>
                                        <div class="r3c2">
                                            <?php
                                                require 'db_connect.php';

                                                $sql = "SELECT COUNT(DISTINCT w.space_id) AS occupied_workspaces
                                                    FROM reservation r
                                                    JOIN workspace w ON r.space_id = w.space_id
                                                    WHERE r.reservation_status = 'Confirmed'
                                                    AND r.reservation_date = CURDATE()";

                                                $result = $conn->query($sql);
                                                $row = $result->fetch_assoc();
                                                $message = "<p style='text-align: center; font-size: 30px; font-weight: bold'>" . $row["occupied_workspaces"] . "</p>";

                                                echo $message;
                                            ?>  
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row4">
                                        <div class="r4c1">
                                            <p class="rowText">OCCUPIED ROOMS: </p>
                                        </div>
                                        <div class="r4c2">
                                            <?php 
                                                require 'db_connect.php';

                                                $sql = "SELECT COUNT(DISTINCT ro.space_id) AS occupied_rooms
                                                    FROM reservation r
                                                    JOIN room ro ON r.space_id = ro.space_id
                                                    WHERE r.reservation_status = 'Confirmed'
                                                    AND r.reservation_date = CURDATE()
                                                    AND r.reservation_time <= CURTIME()
                                                    AND r.expected_timeout >= CURTIME()";

                                                $result = $conn->query($sql);
                                                $row = $result->fetch_assoc();
                                                $message = "<p style='text-align: center; font-size: 30px; font-weight: bold'>" . $row["occupied_rooms"] . "</p>";

                                                echo $message;
                                            ?>
                                        </div>
                                    </div>
                                    <br>
                                    

                                </div>
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