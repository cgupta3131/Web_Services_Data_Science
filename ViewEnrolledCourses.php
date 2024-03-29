<?php
  session_start();

  include("config.php");

  if(!(isset($_SESSION['login']) && $_SESSION['login'] == 1)){
      $host = $_SERVER['HTTP_HOST'];
      header("Location: http://{$host}/Web_Services_Data_Science");
  }
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
  <?php include('top_nav.php'); ?>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./Students/select_course.php">Apply for course</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ViewEnrolledCourses.php">Enrolled Courses</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class='fluid-container'>
      <div class='row' style='padding: 50px 0px 0px 0px;'>
      <div class='col-lg-2'></div>
          <div class='col'>


          </div>
          <div class='col-lg-2'></div>
          </div>
          </div>

  <ul class="cards">
  <?php

  include("config.php");

  $Username = $_SESSION['Username'];

  $query = mysqli_query($connection, "SELECT * FROM EnrolledStudents WHERE Username = '$Username'");

  while($row = mysqli_fetch_assoc($query)){
      $CourseID = $row['CourseID'];
      $query2 = mysqli_query($connection, "SELECT * FROM courses WHERE course_id = '$CourseID'");
      if($row2 = mysqli_fetch_assoc($query2)){
          $CourseName = $row2['course_name'];
          $AboutCourse = $row2['about_course'];
      }
      echo "<li class='cards__item'>
        <div class = 'card'>
        <div class='card__content'>
          <div class='card__title'><a href='CourseHomePage.php?CourseID={$CourseID}'>{$CourseID}</a></div>
          <div class='card__subtitle'>{$CourseName}</div>
          <p class='card__text'>{$AboutCourse}</p>
        </div>
        </div>
      </li>";

  }

  ?>
  </ul>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
