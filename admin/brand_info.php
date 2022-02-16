<?php
session_start();
if($_SESSION['logstatus'] == 1)
{
  include('../database/connect.php');

  $db = new database();

  $brandID = isset($_POST['brandID'])? $_POST['brandID']:"";
  $brandName = isset($_POST['brandName']) ? $_POST['brandName']:"";
  $message = "";

  $fetch_info[0]="";
  $fetch_info[1]="";

  $newId=$db->makeid('brand_info','brand_id','BRAND-','10');

  //echo $newId;

  // Add //
  if(isset($_POST['add']))
  {
    if(!empty($brandID) && !empty($brandName))
    {
      $sql="INSERT INTO `brand_info`(`brand_id`, `brand_name`) VALUES ('$brandID','$brandName')";
      $query=$db->link->query($sql);
      $path="../img/$brandID.jpg";
      move_uploaded_file($_FILES['image']['tmp_name'],$path);
      $message="<span style='color:green; font-size:18px;'>Saved Successfully.</span>";
      $newId=$db->makeid('brand_info','brand_id','BRAND-','10');
    }
    else
    {
      echo "Please fill out all the fields.";
    }
  }
  
  // Edit //
  if(isset($_POST['edit']))
  {
  	if(!empty($brandID) && !empty($brandName))
  	{
  		$sql="UPDATE `brand_info` SET `brand_name`='$brandName' WHERE `brand_id`='$brandID'";
  		$query=$db->link->query($sql);
  		$path="../img/$brandID.jpg";
      move_uploaded_file($_FILES['image']['tmp_name'],$path);
  		//$message="<span style='color:green; font-size:18px;'>Updated Successfully.</span>";

      if($query)
      {
        echo "<script>alert('Update Successfully!!')</script>";
        print "<script>location='brand_info.php'</script>";
      }
  	}
  	else
  	{
  		echo "Please Fill up all the fields.";
  	}
  }

  // Delete //
  if(isset($_POST['delete']))
  {
    if(!empty($brandID))
    {
      $sql="DELETE FROM `brand_info` WHERE `brand_id` = '$brandID'";
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
    $sql=$db->link->query("SELECT * FROM `brand_info` WHERE `brand_id`='".$_GET["edit"]."' ");
    if($sql)
    {
      $fetch_info=$sql->fetch_array(); // 1D Array
      $newId=$fetch_info[0];
    }
  }

  //Delete in View
  if(isset($_GET["del"]))
  {
  	$sql=$db->link->query("DELETE FROM `brand_info` WHERE `brand_id`='".$_GET["del"]."' ");
  	if($sql){
  		echo "<script>alert('Deleted Successfully!!')</script>";
      print "<script>location='brand_info.php'</script>";
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

    <title>Brand Information</title>

    <script type="text/javascript">
    	function confirmdel(){
    	  var del=confirm("Are you sure you want to delete this brand?");
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
  <form method="POST" enctype="multipart/form-data">
    <div class="container pt-5">
       <div class="row">

          <div class="col-12 bg-secondary text-light p-1  text-center"> 
            <h2>Brand Info</h2>
          </div>
            
          <div class="col-3 p-2"> Brand ID </div>
          <div class="col-9 p-2"> 
            <input type="text" name="brandID" class="form-control" value="<?php print $newId?>" placeholder="ID"></input>
          </div>

          <div class="col-3 p-2"> Brand Name </div>
          <div class="col-9 p-2"> 
            <input type="text" name="brandName" class="form-control" value="<?php print $fetch_info[1]?>" placeholder="Brand Name"></input>
          </div>

          <div class="col-3 p-2"> Picture </div>
          <div class="col-9 p-2"> 
            <input type="file" name="image" class="form-control" ></input>
          </div>

          <div class="col-12 p-3 text-center" >
	           <input type="submit" name="add" value="Save" class="btn btn-success"></input> 
	           <input type="submit" name="edit" value="Update" class="btn btn-info"></input> 
	           <input type="submit" name="view" value="View" class="btn btn-primary"></input> 
	           <input type="submit" name="delete" value="Delete" class="btn btn-danger"></input>
	           <input type="submit" name="cancel" value="Cancel" class="btn btn-warning"></input>
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
      <th>Brand ID</th>
      <th>Brand Name</th>
      <th>Image</th>
      <th>Action</th>
    </tr>
  </thead>
  <?php
    $sql=$db->link->query("SELECT * FROM `brand_info`");
    while ($fetch=$sql->fetch_array()) {
  ?>
  <tr>
    <td><?php print $fetch[0]?></td>
    <td><?php print $fetch[1]?></td>
    <td>
    	<?php
    	$img='../img/'.$fetch['brand_id'].'.jpg'; //1.jpg
    	if(file_exists($img))
    	 {?>
    		<img src="<?php print $img?>" height="80" width="80">
    	<?php
	     }
	    else
	    { ?>
	    	 <img src="../img/444.jpg" height="80" width="80">
	    <?php 
		 }
	    ?>

    </td>
    <td>
      <label> 
        <a href="brand_info.php?edit=<?php print $fetch[0]?>" class="btn btn-info btn-sm">Edit</a>
        <a href="brand_info.php?del=<?php print $fetch[0]?>" class="btn btn-danger btn-sm" 
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


  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>

<?php
}
?>







