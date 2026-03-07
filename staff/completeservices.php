<?php
session_start();
include '../config/connect.php';

$conn = (new database)->connection();

if(!$user_id = $_SESSION['user_id']){
    header("location:../auth/login.php");
}

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
    AND a.status = 'completed'
    ORDER BY a.appointment_date ASC
");

$stmt->execute([$staff_id]);
$appointments = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stylists Panel</title>

    <!-- Custom fonts for this template-->
    <link href="../asset/dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../asset/dashboard/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion" style="background-color:#BD193B" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">Stylist</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
                <!-- Nav Item - Pages Collapse Menu -->
           
           

            <!-- Nav Item - Utilities Collapse Menu -->
           
            <!-- Divider -->
           

            <!-- Nav Item - Pages Collapse Menu -->
          

            <!-- Nav Item - Charts -->
          <br>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="completeservices.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Completed Services</span></a>
            </li>
            <br>
              <li class="nav-item">
                <a class="nav-link" href="../auth/../common/profile.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Profile</span></a>
            </li>
            <br>
              <li class="nav-item">
                <a class="nav-link" href="../auth/logout.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Logout</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
           

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        

                       

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                                <img class="img-profile "
                                    src="../asset/frontend/images/elogo.png">
                            <!-- Dropdown - User Information -->
                      

                    </ul>

                </nav>
                <!-- <div class="vh-100"> -->
<div class="appointment-card m-5">


                <div class="card shadow mt-5 mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Completed Appointments</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

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
</div>
</div>
</div>
</div>
     <footer class="sticky-footer mt-auto bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Elegent Salon 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        
    <!-- End of Page Wrapper -->



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
