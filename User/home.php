
  	<div class="container-fluid pt-2" style="background: #f5f5f5;" >
  			<div class="container bg-white">
  				<div class="row"> 
  					<div class="col-md-2 col-12  p-0"> 
  						<ul class="list-group">

						 <li class="list-group-item active" aria-current="true">All Category</li>
						 <?php  $sql=$db->link->query("SELECT * FROM `category_info` ORDER BY `category_name` ASC limit 0,10 ");
						 if($sql)
						 	{
						 		while($fetch_item=$sql->fetch_object())
						 			{
						 				?>
							  				<li class="list-group-item"><a href="#" style="text-decoration: none;">
							  					<?php echo $fetch_item->category_name; ?>
							  					</a></li>
							  	<?php
								}
							}

							  ?>
						</ul>
  					</div>


  				 <div class="col-md-10 col-12"> 

  					<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
							  <div class="carousel-indicators">
							    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
							    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
							    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
							  </div>

							  <div class="carousel-inner">

<?php 
$sql=$db->link->query("SELECT * FROM `gallery` WHERE `slider`='slider' ORDER BY `id` DESC LIMIT 0,3");
if($sql)
{
	$i=0;
		while($fetch_slider=$sql->fetch_object())
		{
			$i++;
						?>
							    <div class="carousel-item <?php if($i=='1'){ echo 'active'; } ?>">
							      <img src="../img/<?php print $fetch_slider->id ?>.jpg" class="d-block w-100" alt="...">
							      <div class="carousel-caption d-none d-md-block">
							        <h5><?php print $fetch_slider->title; ?></h5>
							        <p><?php print $fetch_slider->details; ?></p>
							      </div>
							    </div>
<?php
	}
}
?>

							  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
							    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
							    <span class="visually-hidden">Previous</span>
							  </button>
							  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
							    <span class="carousel-control-next-icon" aria-hidden="true"></span>
							    <span class="visually-hidden">Next</span>
							  </button>
					</div>



							<div class="row"> 
								
							<div class="col-md-3 col-6  bg-white p-3  " style="border-right:1px #ccc solid;">
                                <div class="row">
                                    <div class="col-md-3 col-3 mt-2">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </div>

                                    <div class="col-md-9 col-9">
                                        <a href="https://buynfeel.com/Discount-Mela"
                                                        style="text-decoration:none"><span>
                                            <b>Discount Mela</b>
                                            <br>
                                            The first week of each month
                                        </span></a>
                                    </div>
                                 </div>
                            </div>		

                            <div class="col-md-3 col-6  bg-white p-3 " style="border-right:1px #ccc solid;">
                                <div class="row">
                                    <div class="col-md-3 col-3 mt-2">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </div>

                                    <div class="col-md-9 col-9">
                                        <a href="https://buynfeel.com/Discount-Mela"
                                                        style="text-decoration:none"><span>
                                            <b>Discount Mela</b>
                                            <br>
                                            The first week of each month
                                        </span></a>
                                    </div>
                                 </div>
                            </div>

                            <div class="col-md-3 col-6  bg-white p-3 " style="border-right:1px #ccc solid;">
                                <div class="row">
                                    <div class="col-md-3 col-3 mt-2">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </div>

                                    <div class="col-md-9 col-9">
                                        <a href="https://buynfeel.com/Discount-Mela"
                                                        style="text-decoration:none"><span>
                                            <b>Discount Mela</b>
                                            <br>
                                            The first week of each month
                                        </span></a>
                                    </div>
                                 </div>
                            </div>

                            <div class="col-md-3 col-6  bg-white p-3 " >
                                <div class="row">
                                    <div class="col-md-3 col-3 mt-2">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-9 col-9">
                                        <a href="https://buynfeel.com/Discount-Mela"
                                                        style="text-decoration:none"><span>
                                            <b>Discount Mela</b>
                                            <br>
                                            The first week of each month
                                        </span></a>
                                    </div>
                                 </div>
                            </div>
							</div>
					</div>  				
  				</div>
  			</div>
  	</div>

<div class="container-fluid p-2" style="background: #f5f5f5;"> 
		<div class="container">
			<div class="row">
				<div class="col-3 bg-white"><img src="../img/50.jpg" class="img-fluid"></div>
				<div class="col-3 bg-white"><img src="../img/51.jpg"  class="img-fluid"></div>
				<div class="col-3 bg-white"><img src="../img/52.jpg"  class="img-fluid"></div>
				<div class="col-3 bg-white"><img src="../img/53.jpg"  class="img-fluid"></div>
				
			</div>
		</div>
</div>


<div class="container-fluid " style="background: #f5f5f5;">
		<div class="container" style="background: #f5f5f5;">
		<span style="float: left; clear: right;">SHOP BY CATEGORY'S</span>
		<span style="float: right;"> <a href="?page=allCat" class="btn btn-secondary"> View All Categories </a> </span>
        <br>
        <hr>

			<div class="row">
				<?php  $sql=$db->link->query("SELECT * FROM `category_info` ORDER BY `category_name` ASC limit 0,12 ");
						 if($sql)
						 	{
						 	while($fetch_item=$sql->fetch_object())
						 		{
						 	?>
								<div class="col-md-2 col-6 p-1 text-center">  
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



<div class="container-fluid " style="background: #f5f5f5;">
		<div class="container" style="background: #f5f5f5;">
			<span style="float: left; clear: right;">SHOP BY BRAND</span>
		<span style="float: right;"> <a href="?page=allBrand" class="btn btn-secondary"> View All BRAND </a> </span>
        <br>
        <hr>
			<div class="row">
			<?php  
				$selectBrand=$db->link->query("SELECT * FROM `brand_info` LIMIT 0,6");
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

<div class="container-fluid " style="background: #f5f5f5;">
	<?php
	$sql=$db->link->query("SELECT * FROM `category_info` ORDER BY RAND() LIMIT 0,5");
	while ($fetch_cat=$sql->fetch_array()) {
	?>

		<div class="container p-2 " >
			<br>
			<span><?php print $fetch_cat[2]?></span>
          <hr>
          <div class="row p-3 text-ce"> 
			<?php

				$selectProduct=$db->link->query("SELECT * FROM `product_info`  WHERE `pdt_cat`='$fetch_cat[0]' LIMIT 0,5");
				while ($fetch_product=$selectProduct->fetch_array()) 
				{
			       ?>
		        <div class="col-md-2 col-6 m-3 bg-white">  

							<img src="../img/product/1.jpg" class="img-fluid"> 
							<label> <?php print $fetch_product[0];?></label><br>
							<label><?php print $fetch_product[1];?></label>
				 </div>
				<?php
				 }
				?>
		 </div>
        </div>

        <?php
    }

    ?>
 </div>

