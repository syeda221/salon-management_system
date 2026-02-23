<?php include '../config/connect.php'; 
include '../classes/services.php'; 
$conn = ( new database)->connection();
$table = new services($conn);

$id = $_GET['id'];

$data = $table->ediid($id);

    if($data){
    
if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $data['services_img'] ;
    if(!empty($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp ,"../asset/images/service/".$image );
    }
    $table->ediservice($id,$name,$image,$price);
    header("location:allservices.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
        <div class="container" >
        <div class="row">
        <h1 class="m-auto mb-5 mt-5 col-5">Add New Service</h1>
        </div>
<div class="row">
    
    <form class="m-auto col-6" method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputEmail4">Service Name</label>
      <input type="text" value="<?=$data['service_name']?>"  class="form-control" id="inputEmail4" name="name" placeholder="service name">
    </div>
    <div class="form-group col-md-12">
      <label for="inputPassword4">Price</label>
      <input type="number" class="form-control" value="<?=$data['price']?>" name="price" id="inputPassword4" >
    </div>
  </div>
  <div class="form-row">
     <div class="form-group col-md-12">
      <label for="inputPassword4">Related Image</label>
      <input type="file" class="form-control" name="image" id="inputPassword4" >
    </div>
  </div>
  <button type="submit" name="edit" class="btn mt-4 btn-primary"> Edit</button>
</form>
<?php  } ?>
</div>
</body>
</html>