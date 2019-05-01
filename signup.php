<?php
  include("config.php");

  $EmailExists = "";
  $PasswordEmpty = "";
  $ConfirmEmpty = "";

  if(isset($_POST["submit"]))
  {
    $username = $_POST['username'];
    $unhashed = $_POST["password"];
    $password = md5($_POST["password"]);
    $fullname = $_POST['fullname'];
    $confirmpassword = md5($_POST["confirmpassword"]);
    $designation = $_POST['designation'];


    if(strlen($password) < 6)
      $PasswordEmpty = "*Passsword must be minimum of 6 characters";
    else if($password != $confirmpassword)
      $ConfirmEmpty = "*Both password are not matching";
    else
    {
      $sql2 = "Select * from Users WHERE `Username` = '$username'";
      $retrieve_data = mysqli_query($connection,$sql2);

      $i=0;
      while($row = mysqli_fetch_array($retrieve_data))
      {
          $i=1;
      }

      if($i == 1)
      {
          $EmailExists = "* This EmailID already Exists";
      }

      else
      {
        $query = mysqli_query($connection, "INSERT into Users(Username, Password, FullName, Designation)
                      values('$username', '$password', '$fullname', '$designation')");
      }

      //$host = $_SERVER['HTTP_HOST'];
      //header("Location: http://{$host}Web_Services_Data_Science");
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

        <?php
        if(isset($_SESSION['login']) && $_SESSION['login'] == 1){
            if($_SESSION['Designation'] == 'Student'){
                echo "
                <li class='nav-item'>
                  <a class='nav-link' href='./Students/select_course.php'>Apply for course</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='ViewEnrolledCourses.php'>Enrolled Courses</a>
                </li>
                ";
            }


        echo "<li class='nav-item'>
          <a class='nav-link' href='change_password.php'>Change Password</a>
        </li>";


            if($_SESSION['Designation'] == 'Faculty'){
                echo "
                <li class='nav-item'>
                  <a class='nav-link' href='./Faculty/add_course.php'>Add New Course</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='./Faculty/view_course.php'>My Courses</a>
                </li>

                <li class='nav-item'>
                  <a class='nav-link' href='./Faculty/request_course.php'>Student Requests</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='./Faculty/students_courses.php'>My Students</a>
                </li>
                ";
            }

            if($_SESSION['Designation'] == 'Staff'){
                echo "
                <li class='nav-item'>
                  <a class='nav-link' href='./Staff/all_applicants.php'>View Applicants</a>
                </li>
                ";
            }
        }
        else{
            echo "
            <li class='nav-item'>
                  <a class='nav-link' href='ViewAdvertisements.php'>Advertisements</a>
                </li>
            <li class='nav-item'>
              <a class='nav-link' href='HomeNoticesDisplay.php'>Notice Board</a>
            </li>";
        }
        ?>

      </ul>
    </div>
  </nav>

  <div class='fluid-container'>
      <div class='row' style='padding: 50px 0px 0px 0px;'>
      <div class='col-lg-2'></div>
          <div class='col'>
  <form method="post">
  <div class="form-group">
    <label>Email Address</label>
    <input type="email" class="form-control" name="username" placeholder="Email Address" required>
    <span class="error" style="color:red"> <?php echo $EmailExists; ?></span>
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

  <div class="form-group">
      <label for="studentregno">Semester</label>
      <select name="designation" class='form-control'>
        <option value="Faculty">Faculty</option>
        <option value="Staff">Staff</option>
    </select>
    </div>

  <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
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
