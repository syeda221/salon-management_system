<?php
session_start();
include '../config/connect.php';

$conn = (new database)->connection();

$user_id = $_SESSION['user_id'];

/* GET staff.id using user_id */
$stmt = $conn->prepare("SELECT * FROM staff WHERE user_id = ?");
$stmt->execute([$user_id]);
$staff = $stmt->fetch();

if(!$staff){
    die("Staff record not found");
}

$staff_id = $staff['id'];
$stmt = $conn->prepare("
    SELECT 
        a.id,
        a.appointment_date,
        ts.slot_time,
        c.name AS client_name,c.email AS client_email
    FROM appointments a
    JOIN clients c ON a.client_id = c.id
    JOIN time_slots ts ON a.slot_id = ts.id
    WHERE a.staff_id = ?
    AND a.status = 'confirmed'
    ORDER BY a.appointment_date ASC
");

$stmt->execute([$staff_id]);
$appointments = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Appointments</title>

    <style>
body{
    font-family: Arial, sans-serif;
    background:#ffffff;
    margin:0;
}

/* Navbar */
.navbar{
    background:#AA1532;
}

/* Page heading */
.page-title{
    text-align:center;
    margin-top:40px;
    margin-bottom:20px;
}

/* Table */
table{
    width:80%;
    margin:30px auto;
    border-collapse:collapse;
    background:white;
}

th, td{
    border:1px solid #ddd;
    padding:10px;
    text-align:center;
}

th{
    background:#f5f5f5;
    font-weight:bold;
}

tr:nth-child(even){
    background:#fafafa;
}
    </style>
      <link rel="stylesheet" href="../asset/frontend/css/bootstrap.min.css">

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark  shadow-sm">
  <div class="container-fluid">

    <!-- Brand -->
    <a class="navbar-brand fw-semibold" href="#">Staff Panel</a>

    <!-- Mobile toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#staffNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Right side buttons -->
    <div class="collapse navbar-collapse justify-content-end" id="staffNavbar">
      
      <div class="d-flex gap-4">

        <a href="profile.php" class="btn btn-outline-light  btn-sm">
          View Profile
        </a>



        <a href="../auth/logout.php" class="btn btn-light ms-2 btn-sm">
          Logout
        </a>

      </div>

    </div>
  </div>
</nav>
<div class="appointment-card">

<h2 class="page-title">
    <?=$staff['name']?> Appointments
</h2>

<table>
<tr>
    <th>ID</th>
    <th>Client</th>
    <th>Email</th>
    <th>Date</th>
    <th>Time</th>
</tr>

<?php if(!empty($appointments)){ ?>

    <?php foreach($appointments as $row){ ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['client_name'] ?></td>
        <td><?= $row['client_email'] ?></td>
        <td><?= $row['appointment_date'] ?></td>
        <td><?= $row['slot_time'] ?></td>
    </tr>
    <?php } ?>

<?php }else{ ?>

<tr>
    <td colspan="5" class="no-data">No appointments assigned</td>
</tr>

<?php } ?>

</table>
</div>
</body>
</html>