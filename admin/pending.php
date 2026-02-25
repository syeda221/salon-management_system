<?php
include '../config/connect.php';
include '../classes/oppointment.php';

$conn=(new database)->connection();
$sys=new SalonBookingSystem($conn);
$data=$sys->getPendingAppointments();
?>

<body>

<h2>Pending Appointment Requests</h2>

<table>

<tr>
    <th>Client Name</th>
    <th>Email</th>
    <th>Date</th>
    <th>Time Slot</th>
    <th>Assign Stylist</th>
    <th>Confirm</th>
    <th>Reject</th>
</tr>

<?php if(!empty($data)){ ?>

<?php foreach($data as $row){ ?>

<tr>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['appointment_date']; ?></td>
    <td><?php echo $row['slot_id']; ?></td>

    <!-- ASSIGN + CONFIRM -->
    <td colspan="2">

        <form action="confirm.php" method="POST">

            <input type="hidden" name="id"
                   value="<?php echo $row['id']; ?>">

            <select name="staff_id" required>
                <option value="">Select stylist</option>

                <?php
                $staff = $conn->query("SELECT * FROM staff");
                foreach($staff as $s){
                    echo "<option value='{$s['id']}'>{$s['name']}</option>";
                }
                ?>
            </select>

            <button type="submit">Confirm</button>

        </form>

    </td>

    <!-- REJECT -->
    <td>
        <a class="reject"
           href="reject.php?id=<?php echo $row['id']; ?>"
           onclick="return confirm('Reject this appointment?')">
           Reject
        </a>
    </td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>
    <td colspan="7">No pending appointments</td>
</tr>

<?php } ?>

</table>

</body>