<?php
include '../config/connect.php';
include '../classes/oppointment.php';

$conn=(new database)->connection();
$sys=new SalonBookingSystem($conn);
$data=$sys->getPendingAppointments();
?>

<h2>Pending Requests</h2>

<table border="1">
<tr>
<th>Client</th>
<th>Date</th>
<th>Assign Stylist</th>
<th>Action</th>
</tr>

<?php foreach($data as $row){ ?>

<tr>

<td><?php echo $row['name']; ?></td>
<td><?php echo $row['appointment_date']; ?></td>

<td>
<form action="confirm.php" method="POST">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<select name="staff_id" required>
<option value="">Select stylist</option>
<?php
foreach($conn->query("SELECT * FROM staff") as $s){
echo "<option value='$s[id]'>$s[name]</option>";
}
?>
</select>
</td>

<td>
<button type="submit">Confirm</button>
</form>

<a href="reject.php?id=<?php echo $row['id']; ?>">Reject</a>

</td>

</tr>

<?php } ?>

</table>