<?php
include '../config/connect.php';
include '../classes/oppointment.php';

$conn=(new database)->connection();
$sys=new SalonBookingSystem($conn);

$result=$sys->assignAndConfirm(
$_POST['id'],
$_POST['staff_id']

);

if($result===true){
  echo "<script>
            alert('Appointment confirmed successfully!');
            window.location.href='dashboard.php';
          </script>";
}else{
echo "<script>
            alert('$result');
            window.location.href='pending.php';
          </script>";
}