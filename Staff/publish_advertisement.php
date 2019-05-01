<?php
session_start();
include("includes/config.php");

if(isset($_POST["logout"])){
  session_unset();
  header("Location: ./../index.php");
}

if(!(isset($_SESSION['login']) && $_SESSION['login'] == 1))
{
    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://{$host}/Web_Services_Data_Science");
}

if(isset($_POST["submit"]))
{
  $Header = $_POST['header'];
  $Details = $_POST['Details'];
  $Deadline = $_POST['Deadline'];

  $query = mysqli_query($con, "INSERT into Advertisements(header, details, deadline)
  			values('$Header', '$Details', '$Deadline')");
}

?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="./../index.php">Data Science, IIT Guwahati</a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mr-auto">
          </ul>
          <ul class="navbar-nav">
            <?php
                if(isset($_SESSION['login']) && $_SESSION['login'] == 1){
                    echo "
                    <li class='nav-item'>
                      <a class='nav-link'>
                        Welcome, {$_SESSION['FullName']}
                      </a>
                    </li>


                    <li class='nav-item'>
                    <form method = 'post'>
                        <button type='submit' name='logout' class='nav-link btn btn-light'>Logout</button>
                        </form>
                    </li>

                  </ul>
                    ";
                }
            else{
                echo "
                <li class='nav-item'>
                  <a class='nav-link' href='./../signup.php'>
                    Sign Up
                  </a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='./../signin.php'>
                    Sign In
                  </a>
                </li>
              </ul>
                ";
            }
      ?>

        </div>
      </nav>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="./../index.php">Home</a>
        </li>

        <li class='nav-item'>
          <a class='nav-link' href='./../change_password.php'>Change Password</a>
        </li>

        <li class='nav-item'>
          <a class='nav-link' href='all_applicants.php'>View Applicants</a>
        </li>

        <li class='nav-item'>
          <a class='nav-link' href='publish_advertisement.php'>Publish Advertisement</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='./../HomeNoticeboard.php'>Notice Board</a>
        </li>



      </ul>
    </div>
  </nav>

  <div class='fluid-container'>
      <div class='row' style='padding: 50px 0px 0px 0px;'>
      <div class='col-lg-2'></div>
          <div class='col'>


  <form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label>Advertisement Header</label>
    <input type="text" class="form-control" name="header" placeholder="Advertisement Header" required>
  </div>

  <div class="form-group">
    <label>Details</label>
    <textarea rows="5" class="form-control" name="Details" placeholder="Details of the Advertisement" required></textarea>
  </div>

  <div class="form-group">
    <label>Deadline</label>
    <input type="date" class="form-control" name="Deadline" placeholder="Deadline" required>
  </div>


  <button type="submit" name="submit" class="btn btn-primary">Place Advertisement</button>
</form>

</div>
<div class='col-lg-2'></div>
</div>
</div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
