<?php
session_start();
if($_SESSION['role'] != 2 && $_SESSION['role'] != 1){
    header("location:../auth/login.php");
}
include '../config/connect.php';
include '../classes/oppointment.php';

$conn=(new database)->connection();
$sys=new SalonBookingSystem($conn);

$sys->rejectAppointment($_GET['id']);

echo "<script>
            alert('Appointment Rejected!');
            window.location.href='pending.php';
          </script>";
?>