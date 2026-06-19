<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="message.css"> 

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
                window.open("../Rates/readdisplayrecords.php", "_self")
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
                            <div class="grandchil6">
                                <?php
                                    error_reporting(E_ALL);
                                    ini_set('display_errors', 1);

                                    require 'db_connect.php';

                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $disp_name        = $_POST['disp_name'];
                                        $disp_rentCat     = $_POST['disp_rentCat'];
                                        $disp_price       = $_POST['disp_price'];
                                        $disp_description = $_POST['disp_description'];

                                        $checkStmt = $conn->prepare("SELECT disp_id FROM disp WHERE disp_name = ?");
                                        $checkStmt->bind_param("s", $disp_name);
                                        $checkStmt->execute();
                                        $checkStmt->store_result();

                                        if ($checkStmt->num_rows > 0) {
                                            $message = "<p style='font-size:20px; text-align:center;'>DUPLICATE ENTRY! A RECORD WITH THE NAME \"" . htmlspecialchars($disp_name) . "\" <br>ALREADY EXISTS.</p>";
                                            $checkStmt->close();
                                            $conn->close();
                                        } else {
                                            $checkStmt->close();

                                            if (!isset($_FILES['disp_image']) || $_FILES['disp_image']['error'] !== UPLOAD_ERR_OK) {
                                                die("IMAGE UPLOAD FAILED! ERROR: " . $_FILES['disp_image']['error']);
                                            }

                                            $imageData = file_get_contents($_FILES['disp_image']['tmp_name']);

                                            if (empty($imageData)) {
                                                die("IMAGE DATA IS EMPTY. PLEASE RE-UPLOAD THE FILE.");
                                            }

                                            $stmt = $conn->prepare("INSERT INTO disp 
                                                (disp_name, disp_rentCat, disp_price, disp_description, disp_image) 
                                                VALUES (?, ?, ?, ?, ?)");

                                            $null = null;
                                            $stmt->bind_param("ssdsb", $disp_name, $disp_rentCat, $disp_price, $disp_description, $null);
                                            $stmt->send_long_data(4, $imageData);

                                            if ($stmt->execute()) {
                                                $message = "<p style='font-size:20px; text-align:center;'>A RECORD HAS BEEN SUCCESSFULLY ADDED</p>";
                                            } else {
                                                $message = "<p style='font-size:20px; text-align:center;'>AN ERROR OCCURED. PLEASE TRY AGAIN!</p>";
                                            }

                                            $stmt->close();
                                            $conn->close();
                                        }
                                    }
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