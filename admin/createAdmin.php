<?php
session_start();

if($_SESSION['logstatus']==1)
{
  error_reporting(0);
  include('../database/connect.php');
  $db=new database();

  $message="";
  $fetch_info[0]="";
  $fetch_info[1]="";
  $fetch_info[2]="";
  $fetch_info[3]="";

  $Name=isset($_POST['txtName'])?$_POST['txtName']:"";
  $Email=isset($_POST['txtEmail'])?$_POST['txtEmail']:"";
  $phone=isset($_POST['phone'])?$_POST['phone']:"";
  $Password=isset($_POST['txtPassword'])?$_POST['txtPassword']:"";
  $ConfirmPassword=isset($_POST['ConfirmPassword'])?$_POST['ConfirmPassword']:"";
  $gender=isset($_POST['gender'])?$_POST['gender']:"";

  // Add //
  if(isset($_POST['add']))
  {
    if(!empty($Email) && !empty($Password))
    {
      if($Password==$ConfirmPassword)
      {
        // Insert New Data into DB
        $sql="INSERT INTO create_admin (Name,Email,phone,Password,gender) VALUES('$Name','$Email','$phone','$Password','$gender')";
        $query=$db->link->query($sql);
        $message="<div class='alert alert-success'> Saved Successfully!! </div>";
      }
    }
    else
    {
      echo "Please fill out all the fields.";
    }
  }

  // Edit //
  if(isset($_POST['edit']))
  {
    if(!empty($Email) && !empty($Password))
    {
      if($Password==$ConfirmPassword)
      {
        $sql="UPDATE `create_admin` SET `Name`='$Name',`Password`='$Password',`Email`='$Email',`phone`='$phone',`gender`='$gender' WHERE `Email`='$Email'";

        $query=$db->link->query($sql);
        if($query)
        {
          echo "<script>alert('Update Successfully!!')</script></span>";
          print "<script>location='createAdmin.php'</script>";
        }
      }
    }
    else
    {
      echo "Please fill out all the fields.";
    }
  }


  // Delete //
  if(isset($_POST['delete']))
  {
    if(!empty($Email))
    {
      $sql="DELETE FROM `create_admin` WHERE `Email`='$Email'";
      $query=$db->link->query($sql);
      if($query)
      {
        $message="<span style='color:green; font-size:18px;'>Delete Successfully!!</span>";
      }
    }
  }

  //Edit in View
  if(isset($_GET["edit"]))
  {
		$selectInfo=$db->link->query("SELECT * FROM `create_admin` WHERE `Email`='".$_GET["edit"]."' ");
		if($selectInfo)
		{
			$fetch_info=$selectInfo->fetch_array();
		}
  }

  //Delete in View
  if(isset($_GET["del"]))
  {
    $sql=$db->link->query("DELETE FROM `create_admin` WHERE `Email`='".$_GET["del"]."' ");
    if($sql)
    {
      echo "<script>alert('Delete Successfully!!')</script></span>";
      print "<script>location='createAdmin.php'</script>";
    }
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

    <title>New Admin</title>

    <!-- Data Table CSS -->
    <link rel="stylesheet" type="text/css" href="    https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

    <script type="text/javascript">

      function PasswordMatch()
      {
        var password=document.frmCreateAdmin.txtPassword.value;
        var conpassword=document.frmCreateAdmin.ConfirmPassword.value;
        
        if(password==conpassword)
        {
          document.getElementById("sms").innerHTML = "Password Matched.";
        }
        else
        {
          document.getElementById("sms").innerHTML = "Password Not Matched.";
        }
      }

      function confirmdel()
      {
      	var del=confirm("Do you want to delete?");
      	if(del==true)
      	{
      			return true;
      	}
      	else
      	{
      		return false;
      	}
      }
    </script>

  </head>

  <body>
    <form method="POST" name="frmCreateAdmin">
      <div class="container pt-5">

        <div class="row">

          <div class="col-12 bg-secondary text-light p-1  text-center"> 
            <h2>Create New Admin</h2>
          </div>

          <div class="col-3 p-2"> Name </div>
          <div class="col-9 p-2"> 
            <input type="text" name="txtName" class="form-control" placeholder="Name" value="<?php print $fetch_info[0]?>"></input>
          </div>

          <div class="col-3 p-2"> Email </div>
          <div class="col-9 p-2"> 
            <input type="Email" name="txtEmail" class="form-control" placeholder="Email" value="<?php print $fetch_info[1]?>"></input>
          </div>

          <div class="col-3 p-2"> Phone </div>
          <div class="col-9 p-2"> 
            <input type="text" name="phone" class="form-control" placeholder="Phone no" value="<?php print $fetch_info[2]?>"></input>
          </div>
          
          <div class="col-3 p-2"> Password </div>
          <div class="col-9 p-2"> 
            <input type="password" name="txtPassword" class="form-control" placeholder="Password" id="password" value="<?php print $fetch_info[3]?>"></input> <?php print $fetch_info[2];?>
          </div>

          <div class="col-3 p-2"> Confirm Password </div>
          <div class="col-9 p-2"> 
            <input type="password" name="ConfirmPassword" class="form-control" placeholder="Confirm Password" id="confirmPassword" onkeyup="return PasswordMatch()" value="<?php print $fetch_info[3]?>"></input> 
            <span id="sms"></span>
          </div>

          <div class="col-3 p-2"> Gender </div>
          <div class="col-9 p-2"> 
            <input type="radio" name="gender" value="Male"<?php 
            if(isset($_GET["edit"]))
            {
              if($fetch_info['gender']=="Male")
              {?>
                checked="checked"
              <?php
              }
            }
            ?>> Male
              <input type="radio" name="gender" value="Female" <?php 
            if(isset($_GET["edit"]))
            {
              if($fetch_info['gender']=="Female")
              {?>
                checked="checked"
              <?php
              }
            }
            ?>> Female

            <span id="sms"></span>
          </div>

          <!-- Buttons -->
          <div class="col-12 p-3 text-center" >
            <input type="submit" name="add" value="Save" class="btn btn-success">
            <input type="submit" name="edit" value="Update" class="btn btn-info">
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            <input type="submit" name="view" value="View" class="btn btn-info">
            <input type="submit" name="cancel" value="Cancel" class="btn btn-warning">
            <br>

            <?php
              echo $message;
            ?>
  
          </div>
        </div>
      </div>
    </form>

    <?php
    	if(isset($_POST["view"]))
    	{?>
        <h2 class="text-center">All Admin Data</h2>

        <div class="table-responsive">
        	<!-- Table Start -->  
          <table class="table table-striped table-bordered" id="admindata"> 
           <thead>
            <tr>
              <th>#SL</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Password</th>
              <th>Action</th>
            </tr>
          </thead>
    	<?php 
    		// Read Query and Pass the SQL Command to the Database
        $sql=$db->link->query("SELECT * FROM create_admin ORDER BY Name ASC");

        // Variable for the #SL
        $i = 1;

        // Receive all the Data from 'create_admin' Table using a loop
        while($fetch=$sql->fetch_array())
        {
         ?>
          <tr>
            <td><?php print $i?></td>
            <td><?php print $fetch['Name']?></td>
            <td><?php print $fetch['Email']?></td>
            <td><?php print $fetch['phone']?></td>
            <td><?php print $fetch['Password']?></td>
            <td>
              <label> 
                <a href="createAdmin.php?edit=<?php print $fetch[1]?>" class="btn btn-info btn-sm"> Edit </a>
                <a href="createAdmin.php?del=<?php print $fetch[1]?>" class="btn btn-danger btn-sm" 
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
    <?php
    	}
    ?>

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