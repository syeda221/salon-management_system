<?php include '../config/connect.php'; 
include '../classes/users.php'; 
$conn = ( new database)->connection();
$table = new users($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
</head>
<body>
      <section class="allusers mt-5">
<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>All <b>Users</b></h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Role Id</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                      <?php
                      $data = $table->allusers();
                      if($data){
                        foreach($data as $d){

                
                      ?>
                    <tr>

                        <td><?=$d['role_id']?></td>
                        <td><?=$d['user_name']?></td>
                        <td><?=$d['user_email']?></td>
                        <td>
							
	<a href="editservice.php?id=<?=$d['id']?>" id="open-modal-btn"><i class="material-icons">&#xE254;</i></a>

                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                        
                        <?php

                           }
                      }
                      ?>
                   
                </tbody>
            </table>
        </div>
    </div>   


			
		</div>
	
</section>
</body>
</html>