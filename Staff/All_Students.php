<?php
include("includes/config.php");
session_start();

if(isset($_POST["logout"])){
  session_unset();
  header("Location: ./../index.php");
}

if(isset($_POST["publish_results"]))
{
    $sql = "UPDATE Publish_results SET `IsOpen` = 'Yes' ";
    $update_data = mysqli_query($con,$sql);
}

?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>My Project</title>

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
                  ";
              }
          ?>

        </ul>
      </div>
    </nav>

    <?php
    if(isset($_POST["logout"])){
      session_unset();
      header("Location: ./../index.php");
    }
    ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row" style='padding: 50px 0px 0px 0px;'>
                    <div class="col-md-12">
                        <h1 class="page-head-line">Manage Courses</h1>
                    </div>
                </div>

                <div class="row" style='padding: 20px 0px 0px 0px;'>
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Name</th>
                                            <th>Student Email</th>
                                            <th>Roll Number</th>
                                             <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                    <?php

                                    $sql=mysqli_query($con,"select * from applicant WHERE `selected` = 'True' ");
                                    $cnt=1;
                                    while($row = mysqli_fetch_array($sql))
                                    {
                                      $email = $row['email'];
                                      $sql2 = mysqli_query($con,"select * from Users where `Username` = '$email' ");

                                      while($row2 = mysqli_fetch_array($sql2))
                                      {
                                          $roll_number = $row2['RollNumber'];
                                      }

                                    ?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['name']);?></td>
                                            <td><?php echo htmlentities($email);?></td>
                                            <td><?php echo htmlentities($roll_number);?></td>
                                            <td>

                                            <a href="student_gradecard.php?EmailID=<?php echo $row['email']?>">
                                            <button class="btn btn-primary"><i class="fa fa-edit "></i>View Grade Card</button> </a>

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
                     <!--  End  Bordered Table  -->
                </div>
            </div>


        </div>
    </div>

    <br> <br>
    <form method="post">
        <p align="center">
        <button type="submit" name="publish_results" class="btn btn-primary">Publish Results</button>
      </p>
    </form>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
