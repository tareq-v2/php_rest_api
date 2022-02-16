
<div class="container-fluid " style="background: #f5f5f5;">
		<div class="container" style="background: #f5f5f5;">
			<br>
			<span>Shop By Brands</span>
          <hr>
			<div class="row">
			<?php  
				$selectBrand=$db->link->query("SELECT * FROM `brand_info` ORDER BY `brand_name` ASC");
				if($selectBrand)
				{
						while($fetch_brand=$selectBrand->fetch_object())
						{
			           ?>
					<div class="col-md-2 col-6 p-1">  
						<img src="../img/brand/<?php print $fetch_brand->brand_id;?>.jpg" class="img-fluid"> 
					</div>
			     		<?php
		             }
	            }
	           ?>

			</div>
		</div>
</div>