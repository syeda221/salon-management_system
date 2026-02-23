<?php include '../config/connect.php'; 
include '../classes/services.php'; 
$conn = ( new database)->connection();
$table = new services($conn);

$id = $_GET['id'];
$data = $table->ediid($id);
echo $id;
if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $data['services_img'] ;
    if(!empty($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp ,"../asset/images/service".$image );
    }
    $table->ediservice($id,$name,$price,$image);
    header("location:allservices.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
</head>
<body>
        <div class="container" >
        <div class="row">
        <h1 class="m-auto mb-5 mt-5 col-5">Add New Service</h1>
        </div>
<div class="row">
    <?php
    if($data){
    ?>
    <form class="m-auto col-6" method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputEmail4">Service Name</label>
      <input type="text" value="<?=$data['service_name']?>"  class="form-control" id="inputEmail4" name="name" placeholder="service name">
    </div>
    <div class="form-group col-md-12">
      <label for="inputPassword4">Price</label>
      <input type="number" class="form-control" value="<?=$data['services_img']?>" name="price" id="inputPassword4" >
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