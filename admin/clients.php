

<?php
session_start();
if($_SESSION['role'] != 1){
    header("location:../auth/login.php");
}
include '../config/connect.php';
include '../classes/clients.php';

$conn=(new database)->connection();
$sys=new clients($conn);
$data = $sys->all();
?>

<h2>Confirmed Appointments</h2>

<table border="1" cellpadding="10">

<tr>
<th>Id</th>
<th>Cient-Name</th>
<th>Cient-Email</th>
<th>Phone no</th>


</tr>
<?php foreach($data as $row){ ?>

<tr>
<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['phone']; ?></td>


</tr>

<?php } ?>

</table>

