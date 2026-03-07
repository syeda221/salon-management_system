<?php 
session_start();
if(!isset($_SESSION['role']) || ($_SESSION['role'] != 2 && $_SESSION['role'] != 1)){
    header("location:../auth/login.php");
    exit();
}
require '../classes/oppointment.php';
require '../config/connect.php';
$conn = (new database)->connection();
$appointment_id = $_GET['appointment_id'];

$stmt = $conn->prepare("
SELECT client_id FROM appointments WHERE id=?
");
$stmt->execute([$appointment_id]);
$client_id = $stmt->fetchColumn();
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

<body id="page-top">
<div class="container mt-5">

<div class="card shadow" style="max-width:500px; margin:90px auto;">
    <div class="card-header bg-danger text-white text-center">
        <h4 class="mb-0">Rate Our Service</h4>
    </div>

    <div class="card-body">

        <form method="POST">

            <div class="form-group mb-3">
                <label class="font-weight-bold">Rating</label>
                <select name="rating" class="form-control" required>
                    <option value="">Select Rating</option>
                    <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                    <option value="4">⭐⭐⭐⭐ Very Good</option>
                    <option value="3">⭐⭐⭐ Good</option>
                    <option value="2">⭐⭐ Fair</option>
                    <option value="1">⭐ Poor</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">Message</label>
                <textarea name="message" class="form-control" rows="4" placeholder="Write your feedback..." required></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-danger btn-block">
                Submit Feedback
            </button>

        </form>

    </div>
</div>

</div>

<?php
if(isset($_POST['submit']))
{
    $rating = $_POST['rating'];
    $message = $_POST['message'];

    /* Get client id */
    $stmt = $conn->prepare("
    SELECT client_id FROM appointments WHERE id=?
    ");
    $stmt->execute([$appointment_id]);
    $client_id = $stmt->fetchColumn();

    /* Insert feedback */
    $insert = $conn->prepare("
    INSERT INTO feedback
    (appointment_id, client_id, rating, message)
    VALUES (?,?,?,?)
    ");

    $insert->execute([
        $appointment_id,
        $client_id,
        $rating,
        $message
    ]);

    echo "<script>
     alert(' Thank you for Feedback!');
    window.location.href='../public/index.php';</script>";
}
?>
     <footer class="sticky-footer bg-white mt-auto">
                <div class="container my">
                    <div class="copyright text-center my">
                        <span>Copyright &copy; ELegent Salon 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
</div>
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