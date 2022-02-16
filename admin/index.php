 <?php
session_start();
if($_SESSION['logstatus']==1)
{
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Admin Panel</title>
  </head>

  <body>

    <div class="container-fluid">

      <div class="col-12 bg-primary text-light text-center pt-3" style="height: 150px;"> 
        <h1>Admin Panel</h1>
         <br>
              <?php print 'Welcome '.$_SESSION['name']; ?>
      </div>  

      <div class="col-12 bg-secondary text-light text-center" style="height: 50px;"> 
        <h4><a href="../Login/login.php"  class="text-light"> Logout</a></h4>
      </div> 

      <div class="col-12"> 
        <div class="row">
          <div class="col-md-3 col-6 bg-light" style="height: 500px;">
           <div class="list-group">

            <a href="createAdmin.php" class="list-group-item list-group-item-action active" aria-current="true" target="frmbody">Create New Admin</a>

            <a href="item_info.php" target="frmbody" class="list-group-item list-group-item-action">Item Information</a>

            <a href="category_info.php" class="list-group-item list-group-item-action" target="frmbody">Category Information</a>

            <a href="sub_category_info.php" class="list-group-item list-group-item-action" target="frmbody">Sub Category Information</a>

            <a href="brand_info.php" class="list-group-item list-group-item-action" target="frmbody">Brand Information</a>

            <a href="product_info.php" class="list-group-item list-group-item-action" target="frmbody">Product Information</a>

            <a href="about_us.php" class="list-group-item list-group-item-action" target="frmbody">About Us</a>
            
            <a href="contact_us.php" class="list-group-item list-group-item-action" target="frmbody">Contact Us</a>  
             <a href="gallery.php" class="list-group-item list-group-item-action" target="frmbody"> Photo Gallery </a>    
             <a href="view_user.php" class="list-group-item list-group-item-action" target="frmbody"> view user </a>
        </div>

      </div> 

    <!-- IFrame -->
    <div class="col-md-9 bg-default" style="height: 500px;">
      <iframe src="dashboard.php" name="frmbody" height="100%" width="100%">
      </iframe>
    </div>

    </div>

    </div>


    <div class="col-12 bg-secondary text-light text-center p-4" style="height: 100px;"> 
      <h4>Footer</h4>
    </div> 

  </div>



      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
      -->
  </body>
</html>
<?php
}
else
{
  print "<script>location='../Login/login.php' </script>";

}
?>