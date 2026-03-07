<?php   
session_start();
if($_SESSION['role'] != 2 && $_SESSION['role'] != 1){
    header("location:../auth/login.php");
}

include '../config/connect.php';
include '../classes/oppointment.php';

$conn=(new database)->connection();
$sys=new SalonBookingSystem($conn);
$data=$sys->getPendingAppointments();
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Salon Elegent</title>

    <!-- Custom fonts for this template-->
    <link href="../asset/dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../asset/dashboard/css/sb-admin-2.min.css" rel="stylesheet">

</head>


                <div class="container-fluid">
    <div class="card shadow m-5 ">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Pending Appointment Requests</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

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

        <form action="../common/confirm.php" method="POST">

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
</div>
</div>
</div></div>  <footer class="sticky-footer  bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; ELegent Salon 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="../asset/dashboard/vendor/jquery/jquery.min.js"></script>
    <script src="../asset/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../asset/dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../asset/dashboard/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../asset/dashboard/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../asset/dashboard/js/demo/chart-area-demo.js"></script>
    <script src="../asset/dashboard/js/demo/chart-pie-demo.js"></script>

</body>

</html>