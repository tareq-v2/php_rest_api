
<div class="container-fluid " style="background: #f5f5f5;">
		<div class="container" style="background: #f5f5f5;">
		<span style="float: left; clear: right;">SHOP BY CATEGORY'S</span>
        <br>
        <hr>
			<div class="row">
				<?php  $sql=$db->link->query("SELECT * FROM `category_info` ORDER BY `category_name` ASC ");
						 if($sql)
						 	{
						 	while($fetch_item=$sql->fetch_object())
						 		{
						 	?>
								<div class="col-md-2 col-6 p-3 text-center" style="box-shadow: 0px 2px 2px #ccc;">  
									<img src="../img/50.jpg" class="img-fluid"> <br>
									<label><?php echo $fetch_item->category_name;?></label>
								</div>
									<?php
								}
							}
			?>
			</div>
		</div>
</div>