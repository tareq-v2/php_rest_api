<?php

session_start();
if($_SESSION['logstatus'] == 1)
{
  include('../database/connect.php');
  $db = new database();

  $fetch_info[0]="";
  $fetch_info[1]="";
  $fetch_info[2]="";

  $categoryID=isset($_POST["categoryID"])?$_POST['categoryID']:"";
  $categoryName=isset($_POST["categoryName"])?$_POST['categoryName']:"";
  $itemName=isset($_POST["itemName"])?$_POST['itemName']:"";

  $newId=$db->makeid('category_info','id','CAT-','9');

  // Add //
  if(isset($_POST["add"]))
  {
    $sql="INSERT INTO `category_info`(`id`,`item_id`,`category_name`) VALUES('$categoryID','$itemName','$categoryName')";
    $db->insert($sql);
    $path="../img/$categoryID.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'],$path);
    echo $db->sms;
    $newId=$db->makeid('category_info','id','CAT-','9');
  }

  // Edit //
  if(isset($_POST['edit']))
  {
    if(!empty($categoryID) && !empty($itemName))
    {
      $sql="UPDATE `category_info` SET `item_id`='$itemName' WHERE `id`='$categoryID'";
      $query=$db->link->query($sql);
      $path="../img/$categoryID.jpg";
      move_uploaded_file($_FILES['image']['tmp_name'],$path);
      //$message="<span style='color:green; font-size:18px;'>Updated Successfully.</span>";

      if($query)
      {
        echo "<script>alert('Update Successfully!!')</script>";
        print "<script>location='item_info.php'</script>";
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
    if(!empty($categoryID))
    {
      $sql="DELETE FROM `category_info` WHERE `id`='$categoryID'";
      $query=$db->link->query($sql);
      if($query)
      {
        $message="<span style='color:green; font-size:18px;'>Deleted Successfully!!</span>";
      }
    }
  }  

 // Edit in View
  if(isset($_GET["edit"]))
  {
    $selectCategory=$db->link->query("SELECT `category_info`.*, `item_info`.`name` FROM `category_info`
    INNER JOIN `item_info` ON `item_info`.`id`=`category_info`.`item_id`
    WHERE `category_info`.`id`='".$_GET["edit"]."'");
    if($selectCategory)
    {
      $fetch_info=$selectCategory->fetch_array();
      $newId=$fetch_info[0];
    }
  }

  //Delete in View
  if(isset($_GET["del"]))
  {
    $sql=$db->link->query("DELETE FROM `category_info` WHERE `id`='".$_GET["del"]."' ");
    if($sql){
      echo "<script>alert('Deleted Successfully!!')</script>";
      print "<script>location='category_info.php'</script>";
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
    <title>Category Information</title>

    <script type="text/javascript">
      function confirmdel(){
        var del=confirm("Are you sure you want to delete this item?");
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
          <div class="col-12 bg-secondary text-light text-center">
            <h2>Category Information</h2>
          </div>

          <div class="col-3 p-2">Item Name</div>
          <div class="col-9 p-2">
            <select name="itemName" class="form-control">
              <?php 
              if($selectCategory)
              {?>
                  <option value='<?php echo $fetch_info[1] ?>'><?php echo $fetch_info[3];?></option>
              <?php
              }
              else
              {?>    
                  <option value="">Select Item</option>
              <?php
              }
              $sql=$db->link->query('SELECT * FROM `item_info`');
              while($fetch_item=$sql->fetch_array())
              {?>
                <option value="<?php print $fetch_item[0]?>"><?php print $fetch_item[1]?></option>
              <?php
              }
              ?>
            </select>
          </div>

          <div class="col-3 p-2">Category Name</div>
          <div class="col-9 p-2">
            <input type="text" name="categoryName" class="form-control" placeholder="Category Name"  value="<?php print $fetch_info[2]?>">
          </div>

          <div class="col-3 p-2">Category ID</div>
          <div class="col-9 p-2">
            <input type="text" name="categoryID" class="form-control" placeholder="Category ID"  value="<?php print $newId?>">
          </div>

          <div class="col-3 p-2">Picture</div>
          <div class="col-9 p-2">
            <input type="file" name="image" class="form-control" placeholder="Image">
          </div>
          
          <div class="col-12 text-center p-3">
            <input type="submit" name="add" value="Save" class="btn btn-success">
            <input type="submit" name="edit" value="Update" class="btn btn-info">
            <input type="submit" name="view" value="View" class="btn btn-warning">
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            <input type="submit" name="cancel" value="Cancel" class="btn btn-warning">
          </div>
        </div>
      </div>

    <!-- View -->
    <?php
    if(isset($_POST["view"]))
    {
    ?>
      <div class="table-responsive">
        <table class="table table-striped"> 
          <thead>
            <tr>
              <th>Category ID</th>
              <th>Item Name</th>
              <th>Category Name</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>

          <?php 
          $sql=$db->link->query("SELECT `category_info`.*, `item_info`.`name` FROM `category_info`
          INNER JOIN `item_info` ON `item_info`.`id`=`category_info`.`item_id`");

          while($fetch=$sql->fetch_array())
          {
          ?>
            <tr>
              <td><?php print $fetch[0]?></td>
              <td><?php print $fetch[3]?></td>
              <td><?php print $fetch[2]?></td>
              <td>
                <?php
                $img='../img/'.$fetch['id'].'.jpg';
                if(file_exists($img))
                { ?>
                  <img src="<?php print $img ?>" height="80" width="80" >
                <?php
                }
                else
                {?>
                  <img src="../img/444.jpg" height="80" width="80">
                <?php
                }
                ?>
              </td>

              <td>
                <label> 
                  <a href="category_info.php?edit=<?php print $fetch[0]?>" class="btn btn-info btn-sm"> Edit </a>
                  <a href="category_info.php?del=<?php print $fetch[0]?>" class="btn btn-danger btn-sm" onclick="return confirmdel()"> Delete </a>  
                </label>
              </td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
    <?php
    }
    ?>

    </form>
  </body>
</html>
<?php
}
?>