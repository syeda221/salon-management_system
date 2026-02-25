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
echo "Appointment confirmed";
}else{
echo $result;
}