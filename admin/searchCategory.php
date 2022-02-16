<?php
	include('../database/connect.php');
  	$db = new database();

  	$item=$_POST['item'];

  	$sql=$db->link->query("SELECT `id`,`category_name` FROM `category_info` WHERE `item_id`='$item' "); 

	//$sql=$db->link->query("SELECT `id`,`category_name` FROM `category_info` WHERE `item_id`='".$_POST['item']."'");

	echo '<option value="">Select Category</option>';

	while($fetch_cat=$sql->fetch_array())
    {
    	// Returning to result variable
	    echo "<option value='$fetch_cat[0]'>$fetch_cat[1]</option>";
	}
?>