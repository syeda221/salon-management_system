<?php
session_start();
if($_SESSION['role'] != 2 && $_SESSION['role'] != 1){
    header("location:../auth/login.php");
}
include '../config/connect.php';
include '../classes/oppointment.php';

$conn=(new database)->connection();
$sys=new SalonBookingSystem($conn);

$result=$sys->assignAndConfirm(
$_POST['id'],
$_POST['staff_id']

);

if($result===true){
  if($_SESSION['role'] = 2){
  echo "<script>
            alert('Appointment confirmed successfully!');
            window.location.href='../receptionist/index.php';
          </script>";
  }elseif($_SESSION['role'] = 1)
  echo "<script>
            alert('Appointment confirmed successfully!');
            window.location.href='../admin/index.php';
          </script>";
}else{
echo "<script>
            alert('$result');
            window.location.href='../common/pending.php';
          </script>";
}