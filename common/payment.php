<?php
session_start();
if($_SESSION['role'] != 2 && $_SESSION['role'] != 1){
    header("location:../auth/login.php");
}
include '../config/connect.php';
include '../classes/pay.php';

$db = (new database)->connection();
$payment = new Payment($db);

$appointment_id = $_GET['id'];
$total = $payment->getTotalAmount($appointment_id);
?><!DOCTYPE html>
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
<body class="pt-5">
<div class="container mt-5 ">
<h2 class="mb-5 text-dark text-center mt-5" >Payment</h2>
<div class="card shadow m-auto" style="max-width:500px; ">
    <div class="card-body">

        <p class="mb-5">
            <strong>Total Amount:</strong> 
            <span class="text-danger fw-bold">Rs <?= $total ?></span>
        </p>


   <form method="post">

            <div class="mb-4">
                <label class="form-label">Payment Method</label>
                <select name="method" class="form-control">
                    <option value="cash">Cash</option>
                    <option value="card">Card</option>
                </select>
            </div>

            <button type="submit" name="pay" class="btn btn-danger w-100">
                Pay Now
            </button>

        </form>

    </div>
</div>

<?php
if(isset($_POST['pay'])){
    $amount = $payment->makePayment($appointment_id,$_POST['method']);

    echo "<script>
        alert('Payment successful');
        window.location='invoice.php?id=$appointment_id';
    </script>";
}
?>
</div>
     <footer class="sticky-footer bg-white mt-5">
                <div class="container my-5">
                    <div class="copyright text-center my-5">
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