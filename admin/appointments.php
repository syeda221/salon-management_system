<?php
include '../config/connect.php';
include '../classes/oppointment.php';
$conn = (new database)->connection();
$sys=new SalonBookingSystem($conn);
$data=$sys->getPendingAppointments();
?>

<h2>Pending Appointments</h2>

<table border="1">
<tr>
<th>Name</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php foreach($data as $row){ ?>
<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['appointment_date']; ?></td>
<td>
<a href="confirm.php?id=<?php echo $row['id']; ?>">Confirm</a>
<a href="reject.php?id=<?php echo $row['id']; ?>">Reject</a>
</td>
</tr>
<?php } ?>
</table>