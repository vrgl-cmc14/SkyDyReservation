<?php
include 'db_connect.php';

$space_id = 75;

$availability = [];

$sql = "
    SELECT reservation_date, reservation_status
    FROM reservation
    WHERE space_id = $space_id
";

$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $status = strtolower($row['reservation_status']);

        if ($status === 'confirmed') {
            $availability[$row['reservation_date']] = 'occupied';
        }
        elseif ($status === 'pending') {
            $availability[$row['reservation_date']] = 'pending';
        }
        elseif ($status === 'cancelled') {
            $availability[$row['reservation_date']] = 'available';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Reservation Calendar</title>

<style>
#calendar {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
    margin-top: 20px;
}

.day {
    padding: 10px;
    text-align: center;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    background-color: none;
}

.day.available {
    background: #d4f7d4;
    color: green;
    background: none;
}

.day.pending {
    background: #fff3cd;
    color: goldenrod;
    pointer-events: none;
    background: none;
}

.day.occupied {
    background: #f8d7da;
    color: red;
    pointer-events: none;
    background: none;
}

.day.available:hover {
    background: #a8e6a8;
    transform: scale(1.05);
    transition: 0.2s;
}

.controls {
    text-align: center;
    margin-top: 10px;
}

button {
    padding: 6px 12px;
    margin: 5px;
    background-color: blue;
}

.legend {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 15px;
    font-size: 14px;
}

.legend span {
    padding: 4px 10px;
    border-radius: 4px;
    font-weight: bold;
}
</style>
</head>

<body>

<h2 style="text-align:center;">Test</h2>

<div class="controls">
    <button onclick="prevMonth()">&#8592; Prev</button>
    <span id="monthLabel" style="font-weight:bold; font-size:18px;"></span>
    <button onclick="nextMonth()">Next &#8594;</button>
</div>

<div class="legend">
    <span style="background:#d4f7d4; color:green;">A</span>
    <span style="background:#fff3cd; color:goldenrod;">P</span>
    <span style="background:#f8d7da; color:red;">O</span>
</div>

<div id="calendar"></div>

<script>
let availability = <?php echo json_encode($availability); ?>;
let spaceId = <?php echo json_encode($space_id); ?>;

let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth();

function generateCalendar(year, month) {
    const calendar = document.getElementById("calendar");
    calendar.innerHTML = "";

    const daysInMonth = new Date(year, month + 1, 0).getDate();

    const monthLabel = new Date(year, month).toLocaleString('default', {
        month: 'long',
        year: 'numeric'
    });

    document.getElementById("monthLabel").textContent = monthLabel;

    const firstDay = new Date(year, month, 1).getDay();
    for (let i = 0; i < firstDay; i++) {
        const blank = document.createElement("div");
        calendar.appendChild(blank);
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const dateStr = `${year}-${String(month+1).padStart(2,"0")}-${String(day).padStart(2,"0")}`;
        const status = availability[dateStr] || "available";

        const dayElem = document.createElement("div");
        dayElem.className = "day " + status;
        dayElem.textContent = day;

        if (status === "available") {
            dayElem.addEventListener("click", () => {
                window.location.href = `reservation_form.php?date=${dateStr}&space_id=${spaceId}`;
            });
        }

        calendar.appendChild(dayElem);
    }
}

function prevMonth() {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    generateCalendar(currentYear, currentMonth);
}

function nextMonth() {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    generateCalendar(currentYear, currentMonth);
}

generateCalendar(currentYear, currentMonth);
</script>

</body>
</html>