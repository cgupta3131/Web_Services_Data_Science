<?php
include("includes/config.php");
session_start();

if(isset($_POST["logout"])){
  session_unset();
  header("Location: ./../index.php");
}

if(isset($_POST["submit"]))
{
	$query = mysqli_query($con, "SELECT * FROM courses");
    $i = 0;
    while($row = mysqli_fetch_assoc($query))
        $i += 1;

 	$total_count = $i*20;
 	//echo "Total rows: " . $total_count;

    $query = mysqli_query($con, "SELECT * FROM applicant ORDER BY gatescore DESC");

    $j = 0;
    while($row = mysqli_fetch_assoc($query))
    {
    	if($j > $total_count)
    		break;

        $j += 1;
        $suffix;
        if(strlen($j) == 1)
        	$suffix = "00".$j;
        if(strlen($j) == 2)
        	$suffix = "0".$j;
        if(strlen($j) == 3)
        	$suffix = $j;


        $email_id = $row['email'];
        $full_name = $row['name'];
        $non_hashed_passwd = randomPassword();
        $password = md5($non_hashed_passwd);
        $RollNumber = date("y")."0101".$suffix;

        echo $RollNumber."<br>";

        //Making selected as True
        $sql = "UPDATE applicant SET `selected` = 'True' WHERE `email` = '$email_id';";
    	$update_data = mysqli_query($con,$sql);

    	//Registering Student
    	$sql = "INSERT INTO Users(Username, Password, RollNumber, FullName, Designation)
                    VALUES ('$email_id','$password','$RollNumber','$full_name', 'Student' );";
    	$insert_data = mysqli_query($con,$sql);
    }


}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


?>

<!DOCTYPE html>
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
                  <li class='nav-item'>
                    <a class='nav-link' href='./../HomeNoticeboard.php'>Notice Board</a>
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

	<?php
    $query = mysqli_query($con, "SELECT * FROM applicant");

    $bgcolor = array('bg-success', 'bg-danger', 'bg-warning', 'bg-info');

    $i = 0;
    while($row = mysqli_fetch_assoc($query))
    {
        echo "<div class='card text-white {$bgcolor[$i%4]} mb-3 pull-left col-height col-middle col-xs-5' style='max-width: 100rem;'>
                <h5 class='card-header'>{$row['name']}</h5>
                  <div class='card-body'>
                    <p class='card-text'>{$row['email']}</p>
                  </div>
              </div>";
        $i += 1;
    }
  ?>

  <form method="post">
  <button type="submit" name="submit" class="btn btn-primary">Approve Applicants</button>
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
