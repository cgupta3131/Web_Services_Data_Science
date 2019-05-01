<?php
include("includes/config.php");
session_start();
$_SESSION['username'] = "chirag";
$username = $_SESSION['username'];

$sql=mysqli_query($con,"select * from courses WHERE `username` = '$username' AND `Application_Status` = 'Open' OR `Application_Status` = 'Deadline Passed' ");

while($row = mysqli_fetch_array($sql))
{
	$courseId = $row['course_id'];
	if( isset($_POST[$courseId]) )
	{
		echo "Chirag";
		$sql2=mysqli_query($con,"select * from RequestCourse WHERE `courseID` = '$courseId' ORDER BY `gateScore` DESC");
		$j = 0;
		while($row2 = mysqli_fetch_array($sql2))
		{
			if($j > 20)
				break;
			$j += 1;
			$student_username = $row2['UserName'];
			$sql = "INSERT INTO EnrolledStudents(CourseID, Username) 
					VALUES ('$courseId','$student_username');";

			$insert_data = mysqli_query($con,$sql);
		}

		$sql3 = "UPDATE courses SET `Application_Status` = 'Completed' WHERE `course_id` = '$courseId';";
        $update_data = mysqli_query($con,$sql3);
	}
}


?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Request Courses</title>
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


	<div class='fluid-container'>
        <div class='row' style='padding: 50px 0px 0px 0px;'>
        <div class='col-lg-2'></div>
            <div class='col'>

    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive table-bordered">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Course ID</th>
                        <th>Semester</th>
                        <th> Application Status </th>
                        <th> Last Date </th>
                         <th>Action</th>
                    </tr>
                </thead>


                <tbody>
                <?php


                $sql=mysqli_query($con,"select * from courses WHERE `username` = '$username' AND `Application_Status` = 'Open' OR `Application_Status` = 'Deadline Passed' ");
                $cnt=1;
                while($row = mysqli_fetch_array($sql))
                {
                ?>

                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo htmlentities($row['course_id']);?></td>
                        <td><?php echo htmlentities($row['start_semester']);?></td>
                        <td><?php echo htmlentities($row['Application_Status']);?></td>
                        <td><?php echo htmlentities($row['last_date']);?></td>
                        <td>

                        

                        <a href="view_students.php?idCourse=<?php echo $row['course_id']?>">
                        <button class="btn btn-primary"><i class="fa fa-edit "></i>View Students</button> </a>
                      <form method="post">
                        <button type="submit" name="<?php echo $row['course_id']?>" class="btn btn-default">Register Students</button>
                    	</form>

                        </td>
                    </tr>
                    <?php
                    $cnt++;

                } ?>


                </tbody>

            </table>
        </div>
    </div>

</div>
<div class='col-lg-2'></div>
</div>
</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
