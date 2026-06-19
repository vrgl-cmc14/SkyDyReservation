<?php
require 'db_connect.php';

if (!isset($_GET['id'])) {
    die("No ID provided.");
}
$id = intval($_GET['id']);

$sql = "SELECT * FROM disp WHERE disp_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="displayformm.css"> 
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

                            <form action="updatedisplayrecord.php?id=<?php echo $row['disp_id']; ?>" method="POST" enctype="multipart/form-data">
                                <br>
                                <br>
                                <label>DISPLAY NAME <span>  *</span></label><br>
                                <input class="textfield" type="text" class="inputTextField" maxlength="20" name="disp_name" id="disp_name" placeholder="Example: Sky Pod"
                                    value="<?php echo htmlspecialchars($row['disp_name']); ?>" required><br><br>
                                
                                <br>
                                <label>RENTAL TYPE<span>  *</span></label><br>
                                <input type="radio" name="disp_rentCat" value="Hour" 
                                    <?php if($row['disp_rentCat']=="Hour") echo "checked"; ?> required> Hourly<br>
                                <input type="radio" name="disp_rentCat" value="Whole Day" 
                                    <?php if($row['disp_rentCat']=="Whole Day") echo "checked"; ?> required> Whole Day<br><br>
                                
                                <br>
                                <label>PRICE<span>  *</span></label><br>
                                <input class="textfield" type="number" name="disp_price" id="disp_price" placeholder="Ex: 299"
                                    value="<?php echo htmlspecialchars($row['disp_price']); ?>" required><br><br>

                                <br>
                                <label>DESCRIPTION<span>  *</span></label><br>
                                <textarea class="textfield" name="disp_description" rows="5" cols="40" placeholder="Enter description here..." required><?php echo htmlspecialchars($row['disp_description']); ?></textarea><br><br>

                                <label>IMAGE</label><br><br>
                                <div class="cont">
                                    <div class="ngi">
                                        <label for="disp_image" class="uploadButton"> UPLOAD PHOTO</label><br>
                                        <input type="file" name="disp_image" id="disp_image" style="display: none" accept="image/*"><br><br>
                                    </div>
                                    <div class="ngi2">
                                        <span id="fileName" style="color: black">No file Chosen </span>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <input type="submit" class="submit" value="SUBMIT">
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('disp_image').addEventListener('change', function() {
        const name = this.files[0] ? this.files[0].name : 'No file chosen';
        document.getElementById('fileName').textContent = name;

        const label = document.querySelector('label[for="disp_image"]');
        if (this.files.length > 0) {
            label.classList.add('selected');
        } else {
            label.classList.remove('selected');
        }
    });

            
    </script>
</body>
</html>
