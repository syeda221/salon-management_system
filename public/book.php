<?php include '../config/connect.php';
$conn=(new database)->connection();
?>

<h2>Book Appointment</h2>

<form action="submit.php" method="POST">

Name:<br>
<input name="name" required><br>

Email:<br>
<input name="email" required><br>

Phone:<br>
<input name="phone" required><br>

Date:<br>
<input type="date" name="date" required><br>

Time:<br>
<select name="slot_id">
<?php
foreach($conn->query("SELECT * FROM time_slots") as $t){
echo "<option value='$t[id]'>$t[slot_time]</option>";
}
?>
</select>

<h3>Select Services</h3>

<?php
foreach($conn->query("SELECT * FROM services") as $s){
echo "<input type='checkbox' name='services[]' value='$s[id]'> $s[service_name]<br>";
}
?>

<br>
<button type="submit">Book</button>

</form>