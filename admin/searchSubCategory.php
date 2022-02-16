 <?php
   include('../database/connect.php');
  $db = new database();

  $sql=$db->link->query("SELECT * FROM `subcat_info` WHERE `item_id`='".$_POST['item']."' AND `cat_id`='".$_POST['catName']."'");

  echo '<option value="">Select Sub Category</option>';
  while($fetch_sub_cat=$sql->fetch_array())
  {
             echo "<option value='$fetch_sub_cat[0]'>$fetch_sub_cat[1]</option>";
  }

?>