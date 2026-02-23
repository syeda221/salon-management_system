<?php include '../config/connect.php'; 
include '../classes/services.php'; 
$conn = ( new database)->connection();
$table = new services($conn);

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Services</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
  crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>   .table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 6px 0 0;
        font-size: 22px;
    }
    .table-title .add-new {
        float: right;
		height: 30px;
		font-weight: bold;
		font-size: 12px;
		text-shadow: none;
		min-width: 100px;
		border-radius: 50px;
		line-height: 13px;
    }
	.table-title .add-new i {
		margin-right: 4px;
	}
    table.table {
        table-layout: fixed;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table th:last-child {
        width: 100px;
    }
    table.table td a {
		cursor: pointer;
        display: inline-block;
        margin: 0 5px;
		min-width: 24px;
    }    
	table.table td a.add {
        color: #27C46B;
    }
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table td a.add i {
        font-size: 24px;
    	margin-right: -1px;
        position: relative;
        top: 3px;
    }    
    table.table .form-control {
        height: 32px;
        line-height: 32px;
        box-shadow: none;
        border-radius: 2px;
    }
	table.table .form-control.error {
		border-color: #f50000;
	}
	table.table td .add {
		display: none;
	}
    
button {
    padding: 10px 20px;
    font-size: 1rem;
    background: #4f46e5;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

dialog {
    padding: 2rem;
    border: none;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

/* Styles the background overlay when the dialog is open */
dialog::backdrop {
    background-color: rgba(0, 0, 0, 0.6);
}

h2 {
    margin-top: 0;
}
  </style>
 
</head>
<body>
  <section class="allservices mt-5">
<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>All <b>Services</b></h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Picture</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                      <?php
                      $data = $table->allservice();
                      if($data){
                        foreach($data as $d){

                
                      ?>
                    <tr>

                        <td><?=$d['service_name']?></td>
                        <td><img src="../asset/images/service/<?=$d['services_img']?>" style="width:100px;height:100px" alt=""></td>
                        <td><?=$d['price']?></td>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>