<?php
  session_start();

  include("config.php");

  if(!(isset($_SESSION['login']) && $_SESSION['login'] == 1)){
      $host = $_SERVER['HTTP_HOST'];
      header("Location: http://{$host}/Web_Services_Data_Science");
  }

  // $CourseID = $_SESSION['CourseID'];

  if(isset($_POST["submit"])){
    $NoticeHead = $_POST['NoticeHead'];
    $NoticeBody = ($_POST["NoticeBody"]);
    $Username = $_SESSION['Username'];
    $query = mysqli_query($connection, "INSERT into HomeNotices(Username, NoticeHead, NoticeBody) values('$Username', '$NoticeHead', '$NoticeBody')");
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
          <a class="nav-link" href="./index.php">Home</a>
        </li>

        <?php
            if($_SESSION['Designation'] == 'Student'){
                echo "
                <li class='nav-item'>
                  <a class='nav-link' href='./Students/select_course.php'>Apply for course</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='./ViewEnrolledCourses.php'>Enrolled Courses</a>
                </li>
                ";
            }
        ?>

        <li class="nav-item">
          <a class="nav-link" href="./change_password.php">Change Password</a>
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
                  <a class='nav-link' href='./Staff/All_Students.php'>View Registered Students</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='./Staff/publish_advertisement.php'>Publish Advertisement</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='HomeNoticeboard.php'>Notice Board</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='signup.php'>Register Users</a>
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

    include("config.php");

    $query = mysqli_query($connection, "SELECT * FROM HomeNotices");

    $bgcolor = array('bg-success', 'bg-danger', 'bg-warning', 'bg-info');

    $i = 0;
    while($row = mysqli_fetch_assoc($query)){
        echo "<div class='card text-white {$bgcolor[$i%4]} mb-3 pull-left col-height col-middle col-xs-5' style='max-width: 100rem;'>
                <h5 class='card-header'>{$row['NoticeHead']}</h5>
                  <div class='card-body'>
                    <p class='card-text'>{$row['NoticeBody']}</p>
                  </div>
              </div>";
        $i += 1;
    }

  ?>

  <?php
    if($_SESSION['Designation'] == 'Staff'){
        echo "
        <form method='post'>
        <div class='form-group'>
          <input type='text' class='form-control' name='NoticeHead' placeholder='Notice Heading' required>
        </div>
        <div class='form-group'>
          <textarea rows='5' class='form-control' name='NoticeBody' placeholder='Notice Body' required></textarea>
        </div>
        <button type='submit' name='submit' class='btn btn-primary'>Add notice</button>
      </form>
        ";
    }
  ?>

</div>
<div class='col-lg-2'></div>
</div>
</div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
