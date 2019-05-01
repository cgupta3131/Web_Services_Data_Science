<?php
include("config.php");

$EmailExists="";
$GateScore="";
$Applied="";
if( isset($_POST["submit"]) )
{
  $name = $_POST['name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $age = $_POST['age'];
  $graduationyear = $_POST['graduationyear'];
  $graduationfield = $_POST['graduationfield'];
  $gatescore = $_POST['gatescore'];
  $gatescore_int = number_format($gatescore);

  $sql2 = "Select * from Users WHERE `Username` = '$email'";
  $retrieve_data = mysqli_query($connection,$sql2);

  $i=0;
  while($row = mysqli_fetch_array($retrieve_data))
  {
      $i=1;
  }

  if($i == 1)
  {
      $EmailExists = "* This EmailID already Exists";
  }

  else if($gatescore > 100)
  {
      $GateScore = "* Gate Score must be from 100";
  }

  else
  {
      $ApplicationNumber = randomApplicationNumber();
      $sql = "INSERT INTO applicant(name, email, contact, age, graduationyear, graduationfield, gatescore,application_number ) VALUES ('$name','$email','$contact','$age','$graduationyear', '$graduationfield', '$gatescore_int', $ApplicationNumber );";

      $insert_data = mysqli_query($connection,$sql);
      $Applied = "You have successfully Submitted your Application. Your Application Number is ".$ApplicationNumber;
  }
}


function randomApplicationNumber() 
{
    $alphabet = '1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 12; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
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
        if(isset($_SESSION['login']) && $_SESSION['login'] == 1){
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


        echo "<li class='nav-item'>
          <a class='nav-link' href='change_password.php'>Change Password</a>
        </li>";


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

            if($_SESSION['Designation'] == 'Staff'){
                echo "
                <li class='nav-item'>
                  <a class='nav-link' href='./Staff/all_applicants.php'>View Applicants</a>
                </li>
                ";
            }
        }
        else{
            echo "<li class='nav-item'>
              <a class='nav-link' href='admission.php'>Admission</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='HomeNoticesDisplay.php'>Notice Board</a>
            </li>";
        }
        ?>

      </ul>
    </div>
  </nav>

  <div class='fluid-container'>
      <div class='row' style='padding: 50px 0px 0px 0px;'>
      <div class='col-lg-2'></div>
          <div class='col'>
  <form method="post">
  <div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" placeholder="Name" required>
  </div>

  <div class="form-group">
    <label>Email ID</label>
    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
    <span class="error" style="color:red"> <?php echo $EmailExists; ?></span>
  </div>
  <span class="error" style="color:red"> <?php echo $EmailExists; ?></span>

  <div class="form-group">
    <label>Contact</label>
    <input type="text" class="form-control" name="contact" placeholder="Contact" required>
  </div>

  <div class="form-group">
    <label>Age</label>
    <select class="form-control" name="age" required>
      <?php
        for($year = 18; $year <= 70; $year += 1){
          echo "<option>$year</option>";
        }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label>Graduation Degree</label><br>
    <label>Year</label>
    <select class="form-control" name="graduationyear" required>
      <?php
        for($year = 2015; $year <= date("Y"); $year += 1){
          echo "<option>$year</option>";
        }
      ?>
    </select>
    <br>
    <label>Field</label>
    <select class="form-control" name="graduationfield" required>
      <option>CSE</option>
      <option>ECE</option>
      <option>EE</option>
      <option>Mathematics</option>
    </select>
  </div>

  <div class="form-group">
    <label>GATE Score</label>
    <input type="text" class="form-control" name="gatescore" placeholder="GATE Score" required>
    <span class="error" style="color:red"> <?php echo $GateScore; ?></span>
  </div>

  <button type="submit" name="submit" class="btn btn-primary">Apply</button>
  <br>
  <span class="error" style="color:green"> <?php echo $Applied; ?></span>
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
