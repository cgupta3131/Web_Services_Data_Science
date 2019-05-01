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
		Student Name : {$FullName}
		<br>
		Roll Number  : {$RollNumber}
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
  Student Name : <b><?php echo $FullName?></b>
  <br>
  Roll Number  : <b><?php echo $RollNumber?></b>
  <div class="content-wrapper">
      <div class="container">
            <div class="row">
                  <div class="col-md-12">
                      <h1 class="page-head-line">Grade Card</h1>
                  </div>
              </div>

              <form method="post">

              <div class="row" >
              <div class="col-md-12">
                  <!--    Bordered Table  -->
                  <div class="panel panel-default">
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