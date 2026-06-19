<?php
include 'db_connect.php';

$date     = isset($_GET['date'])     ? $_GET['date']     : '';
$space_id = isset($_GET['space_id']) ? $_GET['space_id'] : '';

$success = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name  = $conn->real_escape_string(trim($_POST['first_name']));
    $middle_name = $conn->real_escape_string(trim($_POST['middle_name']));
    $last_name   = $conn->real_escape_string(trim($_POST['last_name']));
    $suffix      = $conn->real_escape_string(trim($_POST['suffix']));
    $email       = $conn->real_escape_string(trim($_POST['email']));
    $phone       = $conn->real_escape_string(trim($_POST['phone']));
    $sex         = $conn->real_escape_string(trim($_POST['sex']));
    $res_date    = $conn->real_escape_string(trim($_POST['reservation_date']));
    $res_space   = $conn->real_escape_string(trim($_POST['space_id']));


    $sql_reservation = "
        INSERT INTO reservation (space_id, reservation_date, reservation_time, expected_timeout, reservation_status)
        VALUES ('$res_space', '$res_date', '10:00:00', '22:00:00', 'Pending')
    ";

    if ($conn->query($sql_reservation)) {

        $reservation_id = $conn->insert_id;

        $sql_customer = "
            INSERT INTO customer (reservation_id, first_name, middle_name, last_name, suffix, gender, email_address, phone_number)
            VALUES ('$reservation_id', '$first_name', '$middle_name', '$last_name', '$suffix', '$sex', '$email', '$phone')
        ";

        if ($conn->query($sql_customer)) {
            $success = "Reservation submitted successfully for $res_date!";
        } else {
            $error = "Failed to save customer: " . $conn->error;
        }

    } else {
        $error = "Failed to save reservation: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Reservation Form</title>
<style>
body {
    font-family: Arial, sans-serif;
    max-width: 500px;
    margin: 40px auto;
    padding: 20px;
}

h2 {
    text-align: center;
}


</style>
</head>
<body>

<h2>Reservation Form</h2>

<?php if ($success): ?>
    <div class="success"><?php echo $success; ?></div>
    <p style="text-align:center;"><a href="calendar.php">← Back to Calendar</a></p>

<?php else: ?>

<?php if ($error): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<div class="info-box">
    <strong>Selected Date:</strong> <?php echo htmlspecialchars($date); ?><br>
    <strong>Time:</strong> 10:00 AM – 10:00 PM
</div>

<form method="POST">
    <input type="hidden" name="reservation_date" value="<?php echo htmlspecialchars($date); ?>">
    <input type="hidden" name="space_id"          value="<?php echo htmlspecialchars($space_id); ?>">

    <div class="form-group">
        <label>First Name</label>
        <input type="text" name="first_name" placeholder="Juan" required>
    </div>

    <div class="form-group">
        <label>Middle Name</label>
        <input type="text" name="middle_name" placeholder="Santos (optional)">
    </div>

    <div class="form-group name-row">
        <div>
            <label>Last Name</label>
            <input type="text" name="last_name" placeholder="Dela Cruz" required>
        </div>
        <div>
            <label>Suffix</label>
            <select name="suffix">
                <option value="">— None —</option>
                <option value="Jr.">Jr.</option>
                <option value="Sr.">Sr.</option>
                <option value="II">II</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label>Gender</label>
        <select name="sex" required>
            <option value="">— Select —</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>

    <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" placeholder="juan@email.com" required>
    </div>

    <div class="form-group">
        <label>Phone Number</label>
        <input type="tel" name="phone" placeholder="09XXXXXXXXX" pattern="09[0-9]{9}" title="Enter a valid PH mobile number" required>
    </div>

    <button type="submit">Submit Reservation</button>
</form>

<?php endif; ?>

</body>
</html>