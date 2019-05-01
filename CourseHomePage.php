<?php
session_start();
include("config.php");

$_SESSION['CourseID'] = $_GET['CourseID'];
$CourseID = $_SESSION['CourseID'];
$query = mysqli_query($connection, "SELECT * FROM courses WHERE course_id = '$CourseID'");
if($row = mysqli_fetch_assoc($query)){
    $_SESSION['CourseName'] = $row['course_name'];
}
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <?php include("top_nav.php"); ?>

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
              <a class='nav-link' href='ViewEnrolledCourses.php'>Enrolled Courses</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='DownloadGradeCard.php'>Download Grade Card</a>
            </li>
            ";
        }
        else if($_SESSION['Designation'] == 'Faculty'){
            echo "
            <li class='nav-item'>
              <a class='nav-link' href='./Faculty/view_course.php'>My Courses</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='EditCourseGradeCard.php'>Edit Course Grade Card</a>
            </li>
            ";
        }

        echo "<li class='nav-item'>
          <a class='nav-link' href='coursenotice.php'>Course Notice</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='ViewCourseAssignments.php'>Course Assignment</a>
        </li>";

      }


        ?>
      </ul>
    </div>
  </nav>


  <div class='container-fluid'>
      <div class='row' style='padding: 50px 0px 0px 0px;'>
          <div class='col-lg-2'></div>
          <div class='col'>

    <div id="myCarousel" class="carousel slide embed-responsive embed-responsive-16by9" data-ride="carousel">

        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>

    <div class="carousel-inner embed-responsive-item">


        <div class="carousel-item active">
          <img src="media/home/Data-Science-vs.-Big-Data-vs.jpg" class="d-block w-100 h-100" alt="image">
        </div>

        <div class="carousel-item">
          <img src="media/home/1_QGWyxDaFhavZa495eJBO9Q.jpeg" class="d-block w-100 h-100" alt="image">
        </div>

        <div class="carousel-item">
          <img src="media/home/spa-datascience-news.jpg" class="d-block w-100" alt="image">
        </div>
      </div>

    <!-- Left and right controls -->
    <a class="left carousel-control carousel-control-prev" href="#myCarousel" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control carousel-control-next" href="#myCarousel" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>




  </div>
  <div class='col-lg-2'></div>
  </div>
  </div>


  <div class='container-fluid'>
      <div class='row' style='padding: 50px 0px 0px 0px;'>
          <div class='col-lg-1'></div>
          <div class='col'>

        <?php
            echo "<h3>{$_SESSION['CourseID']}</h3>";

            $CourseID = $_SESSION['CourseID'];
            $query = mysqli_query($connection, "SELECT * FROM courses WHERE course_id = '$CourseID'");
            if($row = mysqli_fetch_assoc($query)){
                $AboutCourse = $row['about_course'];
            }

            echo "<h6>{$AboutCourse}</h6>";
        ?>

  </div>
  <div class='col-lg-1'></div>
  </div>
  <div class='row' style='padding: 50px 0px 0px 0px;'></div>
  </div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
