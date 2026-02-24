<?php include '../config/connect.php'; $conn = (new database)->connection();
?>
<h2>Book Appointment</h2>

<form action="oppointment.php" method="POST">

Name:<br>
<input name="name" required><br>

Email:<br>
<input name="email" required><br>

Phone:<br>
<input name="phone" required><br>

Date:<br>
<input type="date" name="date" required><br>

<!-- Staff:<br>
<select name="staff_id">
<?php
foreach($conn->query("SELECT * FROM staff") as $s){
echo "<option value='$s[id]'>$s[name]</option>";
}
?>
</select><br> -->

Time:<br>
<select name="slot_id">
<?php
foreach($conn->query("SELECT * FROM time_slots") as $t){
echo "<option value='$t[id]'>$t[slot_time]</option>";
}
?>
</select><br>

Services:<br>
<?php
foreach($conn->query("SELECT * FROM services") as $srv){
echo "<input type='checkbox' name='services[]' value='$srv[id]'> $srv[service_name]<br>";
}
?>

<br>
<button type="submit">Book</button>

</form>