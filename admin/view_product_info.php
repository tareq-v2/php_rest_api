<?php

  include('../database/connect.php');
  $db = new database();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
   
    <title>Home</title>
  </head>
  <body>
  	<table class="table table-bordered table-striped">
  		<thead> 
  		<tr>
  				<th>Sl</th>
  				<th>Item Name</th>
  				<th>Category Name</th>
  				<th>Sub Category</th>
  				<th>Brand Name</th>
  				<th>Product ID</th>
  				<th>Product Name</th>
  				<th>Price</th>
  				<th>Stock</th>
  				<th>Details</th>
  				<th>Condition</th>
  				<th>Image</th>
  				<th>Action</th>
  		</tr>

  		</thead>
            <tbody>
      <?php

  $sql=$db->link->query("SELECT `item_info`.`name`,`category_info`.`category_name`,`subcat_info`.`subcat_name`,`brand_info`.`brand_name`,`product_info`.`pdt_id`,`pdt_name`,`pdt_price`,`pdt_stock`,`pdt_details`,`pdt_condition` FROM `product_info`
INNER JOIN `item_info` ON `item_info`.`id`=`product_info`.`pdt_item`
INNER JOIN `category_info` ON `category_info`.`id`=`product_info`.`pdt_cat`
INNER JOIN `subcat_info` ON `subcat_info`.`subcat_id`=`product_info`.`pdt_sub_cat`
INNER JOIN `brand_info` ON `brand_info`.`brand_id`=`product_info`.`pdt_brand` ORDER BY `pdt_id` DESC ");
$i=1;

if($sql)
  {
    while($fetch_info=$sql->fetch_object())
    {

      ?>
  			<tr>
  				<td><?php echo $i++; ?></td>
  				<td><?php print $fetch_info->name; ?></td>
          <td><?php print $fetch_info->category_name; ?></td>
  				<td><?php print $fetch_info->subcat_name; ?></td>
  				<td><?php print $fetch_info->brand_name; ?></td>
  				<td><?php print $fetch_info->pdt_id; ?></td>
  				<td><?php print $fetch_info->pdt_name; ?></td>
  				<td><?php print $fetch_info->pdt_price; ?></td>
  				<td><?php print $fetch_info->pdt_stock; ?></td>
  				<td><?php print $fetch_info->pdt_details; ?></td>
  				<td><?php print $fetch_info->pdt_condition; ?></td>
  				<td><img src="../img/product/<?php print $fetch_info->pdt_id;?>.jpg" height="50" width="50"></td>
  				<td><input type="button" name="delete" value="Delete" class="btn btn-danger" onclick="return deleteProduct('<?php print $fetch_info->pdt_id;?>')"></td>
  			</tr>

    <?php
       }
    }

     ?>
  		</tbody>
  	</table>



  </body>
</html>



