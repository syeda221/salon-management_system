 <?php
 session_start();
if($_SESSION['role'] != 2 && $_SESSION['role'] != 1){
    header("location:../auth/login.php");
}
require '../config/connect.php';
$conn = (new Database)->connection();

$data = $conn->query("
SELECT f.*, c.name
FROM feedback f
JOIN clients c ON f.client_id = c.id
ORDER BY f.id DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>All Feedback</title>

    <!-- Custom fonts for this template-->
    <link href="../asset/dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../asset/dashboard/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
 <section class="allservices mt-5">
<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
                    </div>
                </div>
            </div>
              <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">All Feedbacks</h6>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                       <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Rating</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                                               <?php 
            foreach($data as $d): 
            ?>
                    <tr>

                        <td><?=$d['name']?></td>
                        <td><?=$d['rating']?></td>
                        <td><?=$d['message']?></td>
      
            </tr>
                        
                        <?php

                           endforeach; 
                      
                      ?>
                   
                </tbody>
            </table>

                    </div>
</div>
</div>
                        </body>
                        </html>