<?php
session_start();

unset($_SESSION['logstatus']);
unset($_SESSION['name']);

include("../database/connect.php");
$ob=new database();

if(isset($_POST["login"]))
{
  $email=$_POST["email"];
  $password=$_POST["password"];


  if(!empty($email) && !empty($password))
  {

    $sql="SELECT * FROM `create_admin` WHERE `Email`='$email' AND `Password`='$password'";
    $query=$ob->link->query($sql);
    if($query->num_rows>0)
    {
        $fetch=$query->fetch_array();
        if(strcasecmp($fetch['Email'],$email==0) && $password==$fetch['Password'])
        {
    	    $_SESSION['name']=$fetch[0];
    	    $_SESSION['logstatus']=1;
    	    print "<script>location='../Admin/'</script>";
        }
        else
        {
          print "Please Check User Name & Password!!";
        }
      }
      else
      {
        print "Login Unsuccessfully!!";
      }
  }
  else
  {

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Login Form</title>
  </head>
  <body>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <div class="row">
    <div class="col-4" ></div>
<div class="col-4" >
<form method="post">
  <div class="col-12"> <h1>Login Form</h1> </div>
  <div class="mb-3 my-5">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete="off">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password"  name="password" class="form-control" id="exampleInputPassword1" autocomplete="off">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary" name="login">Submit</button>
</form>

</div>


    <div class="col-4" ></div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
  </body>
</html>

