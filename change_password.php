<?php
session_start();

include("config.php");
$EqualPassword = "";
$CorrectPassword = "";
if(!(isset($_SESSION['login']) && $_SESSION['login'] == 1)){
    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://{$host}/Web_Services_Data_Science");
}

if( isset($_POST["submit"]) )
{

  $_SESSION['username'] = "cgupta3131@gmail.com";
  $username = $_SESSION['username'];

  $old_password = $_POST['old_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];
  $hash_old = md5($old_password);

  //echo $new_password."   ".$confirm_password."<br>";
  $retrieve_passwd=mysqli_query($connection,"select * from Users WHERE `Username` = '$username' ");

  while($row = mysqli_fetch_array($retrieve_passwd))
  {
      $passwd = $row['Password'];

      if($hash_old == $passwd)
      {
          if($new_password == $confirm_password)
          {
              $hash_new = md5($new_password);
              $sql = "UPDATE Users SET `Password` = '$hash_new' WHERE `Username` = '$username';";
              $update_data = mysqli_query($connection,$sql);
          }
          else
          {
            $EqualPassword = "Both Passwords don't match";
          }
      }

      else
      {
        $CorrectPassword = "Please Input Correct Password";
      }
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
        ?>

        <li class="nav-item">
          <a class="nav-link" href="change_password.php">Change Password</a>
        </li>

        <?php
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
        ?>


        <?php
            if($_SESSION['Designation'] == 'Staff'){
                echo "
                <li class='nav-item'>
                  <a class='nav-link' href='./Staff/all_applicants.php'>View Applicants</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='HomeNoticeboard.php'>Notice Board</a>
                </li>
                ";
            }
        ?>

      </ul>
    </div>
  </nav>

<div class='fluid-container'>
    <div class='row' style='padding: 50px 0px 0px 0px;'>
    <div class='col-lg-2'></div>
        <div class='col'>
<form name="dept" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="studentregno">Old Password</label>
    <input type="password" class="form-control" id="course_name" name="old_password" required="true" />
    <span class="error" style="color:red"> <?php echo $CorrectPassword; ?></span>
</div>

<div class="form-group">
    <label for="studentregno">New Password</label>
    <input type="password" class="form-control" id="course_id" name="new_password" required="true" />
</div>

<div class="form-group">
    <label for="studentregno">Confirm New Password</label>
    <input type="password" class="form-control" id="about_course" name="confirm_password" required="true" />
    <span class="error" style="color:red"> <?php echo $EqualPassword; ?></span>
</div>

<button type="submit" name="submit" id="submit" class="btn btn-primary">Change Password</button>
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
