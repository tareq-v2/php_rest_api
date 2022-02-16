<?php
session_start();
if($_SESSION['logstatus']==1)
{
    include('../database/connect.php');
  $db=new database();

  if(isset($_GET["active"]))
  {
      $sql=$db->link->query("UPDATE `user_reg` SET `status`='0' WHERE `user_id`='".$_GET["active"]."'");
  }

  if(isset($_GET["inactive"]))
  {
      $sql=$db->link->query("UPDATE `user_reg` SET `status`='1' WHERE `user_id`='".$_GET["inactive"]."'");
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

    <title>Admin Panel</title>
  </head>

  <body>



        <h2 class="text-center">View All Register </h2>

        <div class="table-responsive">
        	<!-- Table Start -->  
          <table class="table table-striped table-bordered" id="admindata"> 
           <thead>
            <tr>
              <th>SL</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Action</th>
            </tr>
          </thead>
    	<?php 
    		// Read Query and Pass the SQL Command to the Database
        $sql=$db->link->query("SELECT * FROM user_reg ORDER BY user_id DESC");

        // Variable for the #SL
        $i = 1;

        // Receive all the Data from 'create_admin' Table using a loop
        while($fetch=$sql->fetch_array())
        {
        

         ?>
          <tr>
            <td><?php print $i?></td>
            <td><?php print $fetch['user_name']?></td>
            <td><?php print $fetch['user_email']?></td>
            <td><?php print $fetch['user_password']?></td>
            <td><?php print $fetch['user_address']?></td>
            <td><?php print $fetch['user_phone']?></td>
            <td>
              <label>
               <?php
                if($fetch['status']==1)
                {?>
                        <a href="view_user.php?active=<?php print $fetch[0]?>" class="btn btn-success btn-sm"> Active </a>
               <?php }
               else
               {?>

                     <a href="view_user.php?inactive=<?php print $fetch[0]?>" class="btn btn-info btn-sm"> Inactive </a>
                <?php

               }
               ?>

        
        <a href="view_user.php?del=<?php print $fetch[1]?>" class="btn btn-danger btn-sm" 
                  onclick="return confirmdel()"> Delete </a> 
              </label>
            </td>
          </tr>
      <?php
        $i++;
        }
      ?>
      </table>
    </div>



    <!-- Jquery LB File -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- Data Table JS-->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() 
      {
        $('#admindata').DataTable();
      } );
    </script>
  </body>
</html>

<?php
}
?>