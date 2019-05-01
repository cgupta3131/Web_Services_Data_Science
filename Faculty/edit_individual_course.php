<?php
include("includes/config.php");
session_start();
$_SESSION['CourseID'] = $_GET['idCourse'];

if( isset($_POST["update"]) )
{
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $about_course = $_POST['about_course'];
    $start_semester = $_POST['start_semester'];

    $sql = "UPDATE courses SET `course_name` = '$course_name', `about_course` = '$about_course', `start_semester` = '$start_semester' WHERE `course_id` = '$course_id';";
    $update_data = mysqli_query($con,$sql);

    if($update_data)
    {
        $_SESSION['msg']="Enroll Successfully !!";
    }

    else
    {
        $_SESSION['msg']="Error : Not Enroll";
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
    <title>View Course</title>
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

          <?php
              if($_SESSION['Designation'] == 'Student'){
                  echo "
                  <li class='nav-item'>
                    <a class='nav-link' href='./../Students/select_course.php'>Apply for course</a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='./../ViewEnrolledCourses.php'>Enrolled Courses</a>
                  </li>
                  ";
              }
          ?>

          <li class="nav-item">
            <a class="nav-link" href="./../change_password.php">Change Password</a>
          </li>

          <?php
              if($_SESSION['Designation'] == 'Faculty'){
                  echo "
                  <li class='nav-item'>
                    <a class='nav-link' href='add_course.php'>Add New Course</a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='view_course.php'>My Courses</a>
                  </li>

                  <li class='nav-item'>
                    <a class='nav-link' href='request_course.php'>Student Requests</a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='students_courses.php'>My Students</a>
                  </li>
                  ";
              }
          ?>


          <?php
              if($_SESSION['Designation'] == 'Staff'){
                  echo "
                  <li class='nav-item'>
                    <a class='nav-link' href='./../Staff/all_applicants.php'>View Applicants</a>
                  </li>
                  ";
              }
          ?>

        </ul>
      </div>
    </nav>

        <div class="content-wrapper">
        <div class="container">

                <div class="row" style='padding: 50px 0px 0px 0px;'>
                    <div class="col-md-12">
                        <div class="panel panel-default">

		<?php
		$sql = mysqli_query($con, "select * from courses where `course_id`='".$_SESSION['CourseID']."'");
		while($row = mysqli_fetch_array($sql))
		{ ?>

        <form name="dept" method="post" enctype="multipart/form-data">
        
        <div class="form-group">
        <label for="studentname">Course Name </label>
        <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo htmlentities($row['course_name']);?>"/>
        </div>

        <div class="form-group">
        <label for="studentname">Course ID </label>
        <input type="text" class="form-control" id="course_id" name="course_id" value="<?php echo htmlentities($row['course_id']);?>"  readonly="true"/>
        </div>

        <div class="form-group">
        <label for="studentname">About Course </label>
        <input type="text" class="form-control" id="about_course" name="about_course" value="<?php echo htmlentities($row['about_course']);?>" />
        </div>

        <div class="form-group">
        <label for="studentregno">Semester</label>
        <select name="start_semester" class='form-control'>
              <option value="Spring">Spring</option>
              <option value="Fall">Fall</option>
        </select>
    </div>
    <?php } ?>

    <button type="submit" name="update" class="btn btn-primary"> Update Course </button>
    </form>

     </div>
     </div>
     </div>
     </div>
     </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>
