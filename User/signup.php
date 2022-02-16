<?php
  if(isset($_POST["submit"]))
  {

      $userReg="INSERT INTO `user_reg`(`user_name`,`user_email`,`user_password`,`user_address`,`user_phone`) VALUES('".$_POST['name']."','".$_POST['email']."','".$_POST["password"]."','".$_POST["phone"]."','".$_POST["address"]."')";
      //echo $userReg;
      $result=$db->link->query($userReg);
      if($result)
      {
          echo "Registration Successfully!!";
      }
  }
?>

<div class="container"> 
    <div class="container-fluid pt-2" style="background: #f5f5f5;" >
      <form method="post">

  <div class="mb-3">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
   
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="text" class="form-control" id="phone" name="phone">
  </div>

  <div class="mb-3">
    <label for="addrerss" class="form-label">Address</label>

    <textarea name="address" class="form-control" rows="5" id="addrerss"> </textarea>
  </div>

  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Registration</button>
</form>
</div>