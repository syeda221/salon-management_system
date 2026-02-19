<?php
session_start();
if($_SESSION['role'] != 3){
    header("location:../auth/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff</title>
</head>
<body>
    <h1>welcome staff</h1>
</body>
</html>