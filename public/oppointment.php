<?php include '../config/connect.php'; 
$conn = ( new database)->connection();
?>

<?php
$date = $_GET['date'];
$slot = $_GET['slot'];
?>

<h2>Book Appointment</h2>

<form method="POST">

<input type="hidden" name="date" value="<?= $date ?>">
<input type="hidden" name="slot" value="<?= $slot ?>">

Name:
<input type="text" name="name" required><br>

Email:
<input type="email" name="email" required><br>

Phone:
<input type="text" name="phone" required><br>

Service:
<select name="service_id">
<?php
$res = $conn->query("SELECT * FROM services");
while($s = $res->fetch()){
echo "<option value='{$s['id']}'>{$s['service_name']}</option>";
}
?>
</select><br>

Staff:
<select name="staff_id">
<?php
$res = $conn->query("SELECT * FROM staff");
while($s = $res->fetch()){
echo "<option value='{$s['id']}'>{$s['name']}</option>";
}
?>
</select><br>

<button type="submit" name="book">Confirm Booking</button>

</form>

<?php
if(isset($_POST['book'])){

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$slot = $_POST['slot'];
$service = $_POST['service_id'];
$staff = $_POST['staff_id'];

$check = $conn->query("SELECT id FROM clients WHERE email='$email'");

if($check->num_rows > 0){
    $client = $check->fetch_assoc();
    $client_id = $client['id'];
}else{
    $conn->query("INSERT INTO clients(name,email,phone)
                  VALUES('$name','$email','$phone')");
    $client_id = $conn->insert_id;
}


$conn->query("INSERT INTO appointments
(client_id,service_id,staff_id,appointment_date,slot_id)
VALUES('$client_id','$service','$staff','$date','$slot')");

echo "Appointment booked successfully!";
}
?>