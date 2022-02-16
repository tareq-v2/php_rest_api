<?php
	include("../database/connect.php");
	$db=new database();
	//echo $db->sms

 	include('header.php'); 

	if(isset($_GET["page"]))
	{
			switch($_GET["page"])
			{
					case "login":
					{
						include("login.php");
					}
					break;
					case "signup":
					{
						include("signup.php");
					}
					break;

						case "allCat":
					{
						include("allCategories.php");
					}
					break;	
					case "allBrand":
					{
						include("allBrand.php");
					}
					break;
					
					default:
					{
						include('home.php');
					}
				   break;
			}
	}
	else
	{
		 	include('home.php'); 
	}

 	include('footer.php'); 

 ?>

   



