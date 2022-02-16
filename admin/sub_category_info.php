<?php
session_start();
if($_SESSION['logstatus'] == 1)
{
  include('../database/connect.php');
  $db = new database();

  $subcatID = isset($_POST['subcatid']) ? $_POST['subcatid'] : "";
  $subcatName = isset($_POST['subcatName']) ? $_POST['subcatName'] : "";
  $itemName = isset($_POST['itemName']) ? $_POST['itemName']:"";
  $categoryName = isset($_POST['categoryName']) ? $_POST['categoryName'] : "";
  
  $fetch_info[0]="";
  $fetch_info[1]="";

  $newId=$db->makeid('subcat_info','subcat_id','SC-','8');

  // Add //
  if(isset($_POST['add']))
  {
     if (!empty($subcatID) && !empty($itemName) && !empty($categoryName) && !empty($subcatName)) {
    $sql="INSERT INTO `subcat_info` (`item_id`, `cat_id`, `subcat_id`, `subcat_name`) VALUES('$itemName','$categoryName', '$subcatID','$subcatName')";
    $db->insert($sql);
    $path="../img/$subcatID.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'],$path);
    echo $db->sms;
    $newId=$db->makeid('subcat_info','subcat_id','SC-','8');
   }
  }

  // Edit //
  if (isset($_POST['edit'])) {
    if (!empty($subcatID) && !empty($itemName) && !empty($categoryName) && !empty($subcatName)) {
      $sql="UPDATE `subcat_info` SET `subcat_name`='$subcatName' WHERE `subcat_id`='$subcatID' ";
      $query=$db->link->query($sql);
      $path="../img/$subcatID.jpg";
      move_uploaded_file($_FILES['image']['tmp_name'],$path);

      if ($query) {
        echo "<script>alert('Updated Successfully!!')</script>";
        print "<script>location='sub_category_info.php'</script>";
      }
      else{
        echo "Please fill up all the field!!";
      }
    }
  }

  // Delete //

  if(isset($_POST['delete'])){
    if(!empty($subcatID)){
      $sql=$db->link->query("DELETE FROM `subcat_info` WHERE `subcat_id`='$subcatID' ");
      if($sql){
        echo "<script>alert('Deleted Successfully!!')</script>";
      }
    }
  }

  // Edit in View
  if(isset($_GET["edit"]))
  {
    $selectSubcat=$db->link->query("SELECT `subcat_info`.*, `item_info`.`name`, `category_info`.`category_name` FROM `subcat_info`
    INNER JOIN `item_info` ON `item_info`.`id`=`subcat_info`.`item_id`
    INNER JOIN `category_info` ON `category_info`.`id`=`subcat_info`.`cat_id`
    WHERE `subcat_info`.`subcat_id`='".$_GET["edit"]."'");

    if($selectSubcat)
    {
      $fetch_info=$selectSubcat->fetch_array();
      $newId=$fetch_info[0];
    }
  }

  //Delete in View
  if(isset($_GET["del"]))
  {
    $sql=$db->link->query("DELETE FROM `subcat_info` WHERE `subcat_id`='".$_GET["del"]."' ");
    if($sql){
      echo "<script>alert('Deleted Successfully!!')</script>";
      print "<script>location='sub_category_info.php'</script>"; 
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

    <title>Sub Category Information</title>

    <script type="text/javascript">
      function confirmdel(){
        var del=confirm("Are you sure you want to delete Sub Category?");
        if(del == true){
          return true;
        }
        else{
          return false;
        }
      }

      // $(document).ready( function(){

      //   $('#itemName').change(fuction(){

      //       searchCategory();

      //   });

      // });

      // Caregory Search
      function searchCategory()
      {
        var itemName=$('#itemName').val();
        //alert(itemName);

        // Pass the value [page_name where to go, value, function]
        $.post("searchCategory.php",{item:itemName},
          function(result)
          {
            if(result!="")
            {
              // Show the result in Category Option
              $('#CategoryName').html(result);
            }
          }
        );
      }

    </script>

  </head>

  <body>
    <form method="POST" enctype="multipart/form-data">
      <div class="container pt-5">
        <div class="row">
          <div class="col-12 bg-secondary text-light text-center">
            <h2>Sub Category Information</h2>
          </div>

          <div class="col-3 p-2">Item Name</div>
          <div class="col-9 p-2">
            <select name="itemName" class="form-control" id="itemName" onchange="return searchCategory()" >

              <?php 
              if($selectSubcat)
              {
                echo "<option value='".$fetch_info[2]."'>".$fetch_info[4]."</option>";
              }
              else
              {
                echo '<option value="">Select Item</option>'; 
              }
                  
              $sql=$db->link->query('SELECT * FROM `item_info` ORDER BY `name` ASC');
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
            <select name="categoryName" class="form-control" id="CategoryName">
              <?php 
               if($selectSubcat)
                {
                  echo "<option value='".$fetch_info[3]."'>".$fetch_info[5]."</option>";
                }
              ?>
            </select>
          </div>

          <div class="col-3 p-2">Sub Category ID</div>
          <div class="col-9 p-2">
            <input type="text" name="subcatid" class="form-control" placeholder="Sub Category ID" 
            value="<?php print $newId?>">
          </div>

          <div class="col-3 p-2">Sub Category Name</div>
          <div class="col-9 p-2">
            <input type="text" name="subcatName" class="form-control" placeholder="Sub Category Name" value="<?php echo $fetch_info[1];?>">
          </div>

          <div class="col-3 p-2">Picture</div>
          <div class="col-9 p-2">
            <input type="file" name="image" class="form-control" placeholder="Image">
          </div>
          
          <div class="col-12 text-center p-3">
            <input type="submit" name="add" value="Save" class="btn btn-success">
            <input type="submit" name="edit" value="Update" class="btn btn-info">
            <input type="submit" name="view" value="View" class="btn btn-primary">
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
          <th>Sub Category ID</th>
          <th>Sub Category Name</th>
          <th>Item Name</th>
          <th>Category Name</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
      </thead>
      <?php 
        $sql=$db->link->query("SELECT `subcat_info`.*, `item_info`.`name`, 
          `category_info`.`category_name` FROM `subcat_info`
        INNER JOIN `item_info` ON `item_info`.`id`=`subcat_info`.`item_id`
        INNER JOIN `category_info` ON `category_info`.`id`=`subcat_info`.`cat_id` ");
        while($fetch=$sql->fetch_array())
        {
      ?>
      <tr>
        <td><?php print $fetch[0]?></td>
        <td><?php print $fetch[1]?></td>
        <td><?php print $fetch[4]?></td>
        <td><?php print $fetch[5]?></td>
        <td>
          <?php
              $img='../img/'.$fetch['subcat_id'].'.jpg';
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
            <a href="sub_category_info.php?edit=<?php print $fetch[0]?>" class="btn btn-info btn-sm"> Edit </a>
            <a href="sub_category_info.php?del=<?php print $fetch[0]?>" class="btn btn-danger btn-sm" onclick="return confirmdel()"> Delete </a>  
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
    <!-- View End -->
    </form>
    
    <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>

  </body>
</html>
<?php
}
?>