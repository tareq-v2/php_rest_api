<?php

session_start();
if($_SESSION['logstatus'] == 1)
{
  include('../database/connect.php');

  $db = new database();

  $photoID = isset($_POST['photoID'])? $_POST['photoID']:"";
  $title   = isset($_POST['title']) ? $_POST['title']:"";
  $details = isset($_POST['details']) ? $_POST['details']:"";
  $slider = isset($_POST['slider']) ? $_POST['slider']:"";
  $gallery = isset($_POST['gallery']) ? $_POST['gallery']:"";

  $message  = "";

  $fetch_info[0]=""; // id
  $fetch_info[1]=""; // title
  $fetch_info[2]=""; // details
  $fetch_info[3]=""; // slider
  $fetch_info[4]=""; // slider

  // table_name, field_name, prefix, id_length (connect.php)
  $newId=$db->makeid('gallery','id','P-','7');

  // Add //
  if(isset($_POST['add']))
  {
    if(!empty($photoID) && !empty($title))
    {
      $sql="INSERT INTO `gallery`(`id`, `title`, `details`,`slider`,`gallery`) VALUES ('$photoID','$title','$details','$slider','$gallery')";
      $query=$db->link->query($sql);

      $path="../img/$photoID.jpg";
      move_uploaded_file($_FILES['image']['tmp_name'],$path);

      $message="<span style='color:green; font-size:18px;'>Saved Successfully.</span>";

      // After adding genrates new id
      $newId=$db->makeid('gallery','id','P-','7');
    }
    else
    {
      echo "Please fill out all the fields.";
    }
  }
  
  // Edit //
  if(isset($_POST['edit']))
  {
  	if(!empty($photoID) && !empty($title))
  	{
  		$sql="UPDATE `gallery` SET `title`='$title',`details`='$details' WHERE `id`='$photoID'";
  		$query=$db->link->query($sql);

  		$path="../img/$photoID.jpg";
      move_uploaded_file($_FILES['image']['tmp_name'],$path);

      if($query)
      {
        echo "<script>alert('Updated Successfully!!')</script>";
        print "<script>location='gallery.php'</script>";
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
    if(!empty($photoID))
    {
      $sql="DELETE FROM `gallery` WHERE `id`='$photoID'";
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
    $sql=$db->link->query("SELECT * FROM `gallery` WHERE `id`='".$_GET["edit"]."' ");
    if($sql)
    {
      $fetch_info=$sql->fetch_array(); // 1D Array
      // swap the current id
      $newId=$fetch_info[0];
    }
  }

  //Delete in View
  if(isset($_GET["del"]))
  {
  	$sql=$db->link->query("DELETE FROM `gallery` WHERE `id`='".$_GET["del"]."' ");
  	if($sql){
  		echo "<script>alert('Deleted Successfully!!')</script>";
      print "<script>location='gallery.php'</script>";
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

    <title>Photo Gallery</title>

    <script type="text/javascript">
    	function confirmdel(){
    	  var del=confirm("Are you sure you want to delete this photo?");
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
            <h2>Photo Gallery</h2>
          </div>
            
          <div class="col-3 p-2"> ID </div>
          <div class="col-9 p-2"> 
            <input type="text" name="photoID" class="form-control" value="<?php print $newId?>" placeholder="ID"></input>
          </div>

          <div class="col-3 p-2"> Title </div>
          <div class="col-9 p-2"> 
            <input type="text" name="title" class="form-control" value="<?php print $fetch_info[1]?>" placeholder="Picture Title"></input>
          </div>

          <div class="col-3 p-2">Details</div>
          <div class="col-9 p-2">
            <textarea class="form-control" name="details" placeholder="Details"><?php print $fetch_info[2]?></textarea>
          </div>

          <div class="col-3 p-2"> Picture </div>
          <div class="col-9 p-2"> 
            <input type="file" name="image" class="form-control" ></input>
            <?php
            $path="../img/".$fetch_info[0].".jpg";
            if(file_exists($path))
            {
            ?>
            <img src="<?php echo $path;?>" style="height: 50px; width: 50px;">
            <?php
          }
          ?>
          </div> 


          <div class="col-3 p-2"> Show </div>
          <div class="col-9 p-2"> 
            <input type="checkbox" name="slider" value="slider" <?php 
            if($fetch_info[3]=="slider"){
              echo 'checked="checked"';
            }?>> Slider  
            <input type="checkbox" name="gallery" value="gallery"<?php 
            if($fetch_info[4]=="gallery"){
              echo 'checked="checked"';
            }?>>  Gallery 
          </div>

          <div class="col-12 p-3 text-center" >
	           <input type="submit" name="add" value="Save" class="btn btn-success">
	           <input type="submit" name="edit" value="Update" class="btn btn-info">
	           <input type="submit" name="view" value="View" class="btn btn-primary">
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
        <th>Photo ID</th>
        <th>Title</th>
        <th>Details</th>
        <th>Slider</th>
        <th>Gallery</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>

    <?php
      $sql=$db->link->query("SELECT * FROM `gallery`");
      while ($fetch=$sql->fetch_array()) {
    ?>

    <tr>
      <td><?php print $fetch['id']?></td>
      <td><?php print $fetch[1]?></td>
      <td><?php print $fetch[2]?></td>
      <td><?php print $fetch[3]?></td>
      <td><?php print $fetch[4]?></td>
      <td>
        <?php
        $img='../img/'.$fetch['id'].'.jpg'; //1.jpg
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
          <a href="gallery.php?edit=<?php print $fetch[0]?>" class="btn btn-info btn-sm">Edit</a>
          <a href="gallery.php?del=<?php print $fetch[0]?>" class="btn btn-danger btn-sm" 
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

    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'details' );
    </script>
 
  </body>
</html>

<?php
}
?>