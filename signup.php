<?php
  include("config.php");

  $PasswordEmpty = "";
  $ConfirmEmpty = "";

  if(isset($_POST["submit"]))
  {
    $username = $_POST['username'];
    $unhashed = $_POST["password"];
    $password = md5($_POST["password"]);
    $fullname = $_POST['fullname'];
    $confirmpassword = md5($_POST["confirmpassword"]);

    
    if(strlen($password) < 6)
      $PasswordEmpty = "*Passsword must be minimum of 6 characters";
    else if($password != $confirmpassword)
      $ConfirmEmpty = "*Both password are not matching";
    else
    {
      $query = mysqli_query($connection, "INSERT into Users(Username, Password, FullName) values('$username', '$password', $fullname)");

      $host = $_SERVER['HTTP_HOST'];
      header("Location: http://{$host}Web_Services_Data_Science"); 
    }
  }
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <?php include('top_nav.php'); ?>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
      </ul>
    </div>
  </nav>

  <form method="post">
  <div class="form-group">
    <label>Email Address</label>
    <input type="email" class="form-control" name="username" placeholder="Email Address" required>
  </div>

  <div class="form-group">
    <label>Full Name</label>
    <input type="text" class="form-control" name="fullname" placeholder="Full Name" required>
  </div>


  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password" required>
    <span class="error"><?php echo $PasswordEmpty; ?></span>
  </div>


  <div class="form-group">
    <label>Confirm Password</label>
    <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required>
    <span class="error"><?php echo $ConfirmEmpty; ?></span>
  </div>

  <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
</form>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
