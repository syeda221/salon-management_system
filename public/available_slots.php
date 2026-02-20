<?php include '../config/connect.php'; 
$conn = ( new database)->connection();
?>


<form method="GET">
    Select Date:
    <input type="date" name="date" required>
    <button type="submit">Check</button>
</form>

<?php
if(isset($_GET['date'])){

$date = $_GET['date'];

$query = "
SELECT ts.id, ts.slot_time
FROM time_slots ts
WHERE ts.id NOT IN (
    SELECT slot_id FROM appointments
    WHERE appointment_date='$date'
    AND status='booked'
)
";

$result = $conn->query($query);

echo "<h3>Available Slots</h3>";

while($row = $result->fetch()){
    echo "<a href='oppointment.php?date=$date&slot=".$row['id']."'>
            ".$row['slot_time']."
          </a><br>";
}
}
?>