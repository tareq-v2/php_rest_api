<?php

session_start();
error_reporting(0);
if($_SESSION['logstatus'] == 1)
{
  include('../database/connect.php');

  $db = new database();

  $title = isset($_POST['title'])? $_POST['title']:"";
  $details = isset($_POST['details']) ? $_POST['details']:"";
  $map = isset($_POST['map']) ? $_POST['map']:"";
  $message = "";

  $fetch_info[0]="";
  $fetch_info[1]="";
  $fetch_info[2]="";

  $selectData=$db->link->query("SELECT * FROM `contact_us`");
  if($selectData)
  {
    $fetch_info=$selectData->fetch_array(); // 1D Array
  }

  // Add
  if(isset($_POST['add']))
  {
    if(!empty($title) && !empty($details))
    {
      $db->link->query("DELETE FROM `contact_us`");

      $sql="INSERT INTO `contact_us`(`title`, `details`, `map`) VALUES ('$title','$details','$map')";
      $query=$db->link->query($sql);

      // $path="../img/$title.jpg";
      // move_uploaded_file($_FILES['image']['tmp_name'],$path);
      // $message="<span style='color:green; font-size:18px;'>Saved Successfully.</span>";

      $sql=$db->link->query("SELECT * FROM `contact_us`");
      if($sql)
      {
        $fetch_info=$sql->fetch_array(); // 1D Array
      }
    }
    else
    {
      echo "Please fill out all the fields.";
    }
  }

  // Delete //
  if(isset($_POST['delete']))
  {
    if(!empty($brandID))
    {
      $sql="DELETE FROM `contact_us` WHERE `title`='$title'";
      $query=$db->link->query($sql);
      if($query)
      {
        $message="<span style='color:green; font-size:18px;'>Deleted Successfully!!</span>";
      }
    }
  }

  //Edit in View
  if(isset($_GET["edit"]))
  {
    $sql=$db->link->query("SELECT * FROM `contact_us` WHERE `title`='".$_GET["edit"]."' ");
    if($sql)
    {
      $fetch_info=$sql->fetch_array(); // 1D Array
    }
  }

  //Delete in View
  if(isset($_GET["del"]))
  {
    $sql=$db->link->query("DELETE FROM `contact_us` WHERE `title`='".$_GET["del"]."' ");
    if($sql){
      echo "<script>alert('Deleted Successfully!!')</script>";
      print "<script>location='contact_us.php'</script>";
    }
  }
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Contact Us</title>

     <!-- Confirm Delete -->
    <script type="text/javascript">
      function confirmdel(){
        var del=confirm("Are you sure you want to delete this info?");
        if(del == true){
          return true;
        }
        else{
          return false;
        }
      }
    </script>

  </head>

  <body>
    <form method="POST">
      <div class="container pt-5">
        <div class="row">
          <div class="col-12 bg-secondary text-light text-center">
            <h2>Contact Us</h2>
          </div>

          <div class="col-3 p-2">Title</div>
          <div class="col-9 p-2">
            <input type="text" name="title" class="form-control" placeholder="Title"
            value="<?php print $fetch_info[0]; ?>">
          </div>

          <div class="col-3 p-2">Details</div>
          <div class="col-9 p-2">
            <textarea class="form-control" name="details" placeholder="Details"><?php print $fetch_info[1]; ?></textarea>
          </div>

          <div class="col-3 p-2">Map</div>
          <div class="col-9 p-2">
            <input type="text" name="map" class="form-control" placeholder="Map" value="<?php echo $fetch_info[2]?>">
           
            </input>
          </div>
          
          <div class="col-12 text-center p-3">
            <input type="submit" name="add"    value="Save" class="btn btn-success">
            <input type="submit" name="view"   value="View" class="btn btn-primary">
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            <input type="submit" name="cancel" value="Cancel" class="btn btn-warning">
          </div>
          <?php
            echo $message;
          ?>

        </div>
      </div>
    </form>

    <!-- View -->
    <?php
    if (isset($_POST["view"])) {
    ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Title</th>
          <th>Details</th>
          <th>Map</th>
          <th>Action</th>
        </tr>
      </thead>
      <?php
        $sql=$db->link->query("SELECT * FROM `contact_us`");
        while ($fetch=$sql->fetch_array()) {
      ?>
      <tr>
        <td><?php print $fetch[0]?></td>
        <td><?php print $fetch[1]?></td>
        <td>
          <iframe src="<?php print $fetch[2]?>" height="100" width="100"></iframe>
        </td>
        
        <td>
          <label> 
            <a href="contact_us.php?edit=<?php print $fetch[0]?>" class="btn btn-info btn-sm">Edit</a>
            <a href="contact_us.php?del=<?php print $fetch[0]?>" class="btn btn-danger btn-sm" 
              onclick="return confirmdel()">Delete</a>
          </label>
        </td>
      </tr>
      <?php
      }
      ?>
    </table>
    <?php  
    }
    ?>
    <!-- View End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

<?php
}
?>
