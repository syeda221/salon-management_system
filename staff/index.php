<?php
session_start();
include '../config/connect.php';

$conn = (new database)->connection();

$user_id = $_SESSION['user_id'];

/* GET staff.id using user_id */
$stmt = $conn->prepare("SELECT id FROM staff WHERE user_id = ?");
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
        c.name AS client_name
    FROM appointments a
    JOIN clients c ON a.client_id = c.id
    JOIN time_slots ts ON a.slot_id = ts.id
    WHERE a.staff_id = ?
    AND a.status = 'confirmed'
    ORDER BY a.appointment_date ASC
");

$stmt->execute([$staff_id]);
$appointments = $stmt->fetchAll();$stmt = $conn->prepare("
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
            font-family: Arial;
            padding: 30px;
            background:#f4f6f8;
        }

        table{
            width:100%;
            border-collapse: collapse;
            background:white;
        }

        th,td{
            padding:12px;
            border:1px solid #ddd;
            text-align:center;
        }

        th{
            background:#007bff;
            color:white;
        }

        h2{
            margin-bottom:20px;
        }
    </style>
</head>

<body>

<h2>My Appointments</h2>

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
    <td colspan="5">No appointments assigned</td>
</tr>

<?php } ?>

</table>

</body>
</html>