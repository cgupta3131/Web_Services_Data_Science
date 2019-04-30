<?php
include("includes/config.php");
session_start();

if( isset($_POST["submit"]) )
{

  $_SESSION['username'] = "cgupta3131@gmail.com";
  $username = $_SESSION['username'];

  $old_password = $_POST['old_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];
  $hash_old = md5($old_password);

  //echo $new_password."   ".$confirm_password."<br>";
  $retrieve_passwd=mysqli_query($con,"select * from Users WHERE `Username` = '$username' ");

  while($row = mysqli_fetch_array($retrieve_passwd))
  {
      $passwd = $row['Password'];
      //echo $passwd . "<br>";
      //echo $hash_old;

      if($hash_old == $passwd)
      {
          if($new_password == $confirm_password)
          {
              $hash_new = md5($new_password);
              $sql = "UPDATE Users SET `Password` = '$hash_new' WHERE `Username` = '$username';";
              $update_data = mysqli_query($con,$sql);
          }
          else
          {
            $message = "Two passwords don't match";
            echo "<script type='text/javascript'>alert('$message');</script>";
          }
      } 

      else
      {
        $message = "Please Input Correct Password";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
  }
}

?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Change Password</title>
</head>

<body>

    <div class="panel-body">
    <form name="dept" method="post" enctype="multipart/form-data">

    
    <div class="form-group">
    	<label for="studentregno">Old Password</label>
    	<input type="text" class="form-control" id="course_name" name="old_password"/>
  	</div>

  	<div class="form-group">
    	<label for="studentregno">New Password</label>
    	<input type="text" class="form-control" id="course_id" name="new_password"/>
  	</div>

  	<div class="form-group">
    	<label for="studentregno">Confirm New Password</label>
    	<input type="text" class="form-control" id="about_course" name="confirm_password"/>
  	</div>

   	<button type="submit" name="submit" id="submit" class="btn btn-default">Change Password</button>

   </form>
   	</div>
   
   


   	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
</body>
</html>