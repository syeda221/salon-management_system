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
        /* body{
            font-family: Arial;
            padding: 30px;
            background:#f4f6f8;
        } */

        table{
            width:80%;
            border-collapse: collapse;
            background:white;
        }

        th,td{
            padding:12px;
            border:1px solid #ddd;
            text-align:center;
        }

        th{
            background-color:#AA1532;
            color:white;
        }

        h2{
            margin-bottom:20px;
        }
        .navbar{
            background-color:#AA1532;
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
      
      <div class="d-flex gap-2">

        <a href="profile.php" class="btn btn-outline-light  btn-sm">
          View Profile
        </a>

        <a href="edit_profile.php" class="btn btn-light btn-sm">
          Edit Profile
        </a>

        <a href="logout.php" class="btn btn-danger btn-sm">
          Logout
        </a>

      </div>

    </div>
  </div>
</nav>
<div > 
<h2 class="text-center mt-5 p-3"><?=$staff['name']?> Appointments</h2>

<table class="m-auto mt-5">

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
    <td colspan="5">No appointments assigned</td>
</tr>

<?php } ?>

</table>
</div>
</body>
</html>