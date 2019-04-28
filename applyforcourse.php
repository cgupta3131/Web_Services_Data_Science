<?php
  include("config.php");

  if(isset($_POST["submit"])){
    $username = $_POST['username'];
    $password = md5($_POST["password"]);
    $query = mysqli_query($connection, "SELECT * FROM Users WHERE Username='$username' and Password='$password'");

    if($query->num_rows > 0){
      session_start();

      $_SESSION['username'] = $username;

      $host = $_SERVER['HTTP_HOST'];
      // echo "<script type='text/javascript'>alert('$host');</script>";
      header("Location: http://{$host}/Web_Services_Data_Science");
    }
    else{

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
    <label>Name</label>
    <input type="text" class="form-control" name="name" placeholder="Name" required>
  </div>
  <div class="form-group">
    <label>Email ID</label>
    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
  </div>
  <div class="form-group">
    <label>Contact</label>
    <input type="text" class="form-control" name="contact" placeholder="Contact" required>
  </div>
  <div class="form-group">
    <label>Age</label>
    <select class="form-control" name="age" required>
      <?php
        for($year = 10; $year <= 70; $year += 1){
          echo "<option>$year</option>";
        }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label>Graduation Degree</label><br>
    <label>Year</label>
    <select class="form-control" name="graduationyear" required>
      <?php
        for($year = 1990; $year <= date("Y"); $year += 1){
          echo "<option>$year</option>";
        }
      ?>
    </select>

    <label>Field</label>
    <select class="form-control" name="graduationfield" required>
      <option>CSE</option>
      <option>ECE</option>
      <option>EE</option>
      <option>Mathematics</option>
    </select>
  </div>
  <div class="form-group">
    <label>GATE Score</label>
    <input type="text" class="form-control" name="gatescore" placeholder="GATE Score" required>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Apply</button>
</form>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
