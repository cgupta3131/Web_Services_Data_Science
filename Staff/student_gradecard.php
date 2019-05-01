<?php
include("includes/config.php");
session_start();

$Username = $_GET['EmailID'];
$sql = mysqli_query($con, "SELECT * FROM Users WHERE `Username`='$Username'");
$FullName = "";
$RollNumber = "";

if($row = mysqli_fetch_assoc($sql))
{
	$FullName = $row['FullName'];
	$RollNumber = $row['RollNumber'];
}


if(isset($_POST["logout"]))
{
  session_unset();
  header("Location: ./../index.php");
}

  require_once '../dompdf/lib/html5lib/Parser.php';
  require_once '../dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
  require_once '../dompdf/lib/php-svg-lib/src/autoload.php';
  require_once '../dompdf/src/Autoloader.php';
  Dompdf\Autoloader::register();
  use Dompdf\Dompdf;


  if(isset($_POST["viewpdf"]))
  {

      // instantiate and use the dompdf class
      $dompdf = new Dompdf();
      $HTMLCode = "
      <div class='content-wrapper'>
          <div class='container'>
                <div class='row'>
                      <div class='col-md-12'>
                          <center><h1 class='page-head-line'>Grade Card</h1></center>
                        </div>
                    </div>

                    <div class='row'>
                    <div class='col-md-12'>
					<div class='panel panel-default'>
					  <b>Student Name : </b>{$FullName}
					  <br>
					  <b>Roll Number  : </b>{$RollNumber}
						<div class='panel-body'>
							<div class='table-responsive table-bordered'>
								<table class='table'>
									<thead>
										<tr>
											<th>Course ID</th>
											<th>Course Name</th>
											<th>Grade</th>
										</tr>
									</thead>


									<tbody>
                    ";

    $query = mysqli_query($con, "SELECT * FROM EnrolledStudents WHERE Username='$Username'");

    $i = 0;
    while($row = mysqli_fetch_assoc($query))
    {
        $CourseID = $row['CourseID'];
        $query2 = mysqli_query($con, "SELECT * FROM courses WHERE course_id='$CourseID'");

        if($row2 = mysqli_fetch_assoc($query2))
            $CourseName = $row2['course_name'];

        if($row['Grade'] == NULL)
            $Grade = 'Not allotted yet';

        else
        	$Grade = $row['Grade'];

        $HTMLCode .= "<tr>
                  <td>{$CourseID}</td>
                  <td>{$CourseName}</td>
                  <td>{$Grade}</td>
              </tr>";

        $i += 1;
    }

      $HTMLCode .= "
                  </tbody>

              </table>
            </div>
            </div>
            </div>
            </div>
            </div>

            </div>
            </div>
      ";

      $dompdf->loadHtml($HTMLCode);

      // (Optional) Setup the paper size and orientation
      $dompdf->setPaper('A4', 'portrait');

      // Render the HTML as PDF
      $dompdf->render();

      // Output the generated PDF to Browser
      $dompdf->stream();
  }

?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>


	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">
	    <img src="./../media/home/iitglogo.png" width="40" height="40" alt="">
	  </a>
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
          <a class='nav-link' href='./../Staff/All_Students.php'>View Registered Students</a>
        </li>

        <li class='nav-item'>
          <a class='nav-link' href='publish_advertisement.php'>Publish Advertisement</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='./../HomeNoticeboard.php'>Notice Board</a>
        </li>

        <li class='nav-item'>
          <a class='nav-link' href='./../signup.php'>Register Users</a>
        </li>


      </ul>
    </div>
  </nav>



  <div class="content-wrapper">
      <div class="container">
            <div class="row" style="padding: 50px 0px 0px 0px;">
                  <div class="col-md-12">
                      <h1 class="page-head-line">Grade Card</h1>
                  </div>
              </div>

              <form method="post">

              <div class="row" style="padding: 20px 0px 0px 0px;">
              <div class="col-md-12">
                  <!--    Bordered Table  -->
                  <div class="panel panel-default">
					  <b>Student Name : </b><?php echo $FullName?>
					  <br>
					  <b>Roll Number  : </b><?php echo $RollNumber?>
                      <!-- /.panel-heading -->
                      <div class="panel-body">
                          <div class="table-responsive table-bordered">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Course ID</th>
                                          <th>Course Name</th>
                                          <th>Grade</th>
                                      </tr>
                                  </thead>


                                  <tbody>

                                  <?php

                                  $query = mysqli_query($con, "SELECT * FROM EnrolledStudents WHERE Username='$Username'");

                                  $i = 0;
                                  while($row = mysqli_fetch_assoc($query))
                                  {
                                      $CourseID = $row['CourseID'];
                                      $query2 = mysqli_query($con, "SELECT * FROM courses WHERE course_id='$CourseID'");

                                      if($row2 = mysqli_fetch_assoc($query2))
                                        $CourseName = $row2['course_name'];

                                      if($row['Grade'] == NULL)
                                        $Grade = 'Not allotted yet';

                                      else
                                      	$Grade = $row['Grade'];

                                      echo "<tr>
                                                <td>{$CourseID}</td>
                                                <td>{$CourseName}</td>
                                                <td>{$Grade}</td>
                                            </tr>";
                                      $i += 1;
                                  }

                                  ?>

                                  </tbody>

                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          </form>

          <form method="post">
              <button type="submit" name="viewpdf" class="btn btn-primary">Download Grade Card</button>
        </form>

      </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
