<?php
  include('../database/connect.php');
  $db = new database();
 $newId=$db->makeid('product_info','pdt_id','PDT-','10');

if(!empty($_POST['productName']) && !empty($_POST['itemName']))
{
$sql=$db->link->query("INSERT INTO `product_info` (`pdt_id`,`pdt_name`,`pdt_item`,`pdt_cat`,`pdt_sub_cat`,`pdt_brand`,`pdt_price`,`pdt_details`,`pdt_condition`,`pdt_stock`,`pdt_status`) VALUES('".$newId."','".$_POST['productName']."','".$_POST['itemName']."','".$_POST['catName']."','".$_POST['subCategory']."','".$_POST['BrandName']."','".$_POST['ProductPrice']."','".$_POST['productDetails']."','".$_POST['ProductCondition']."','".$_POST['ProductStock']."','".$_POST['ProductStatus']."')");
     
      $path="../img/product/".$newId.'.jpg';
	  move_uploaded_file($_FILES['file']['tmp_name'],$path);
	if($sql)
	{
			print "Insert Successfully";
	}
}



?>