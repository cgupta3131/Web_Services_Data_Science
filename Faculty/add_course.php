<?php
include("includes/config.php");
session_start();

if( isset($_POST["submit"]) )
{
  //Remove this line when getting the data
  $_SESSION['username'] = "chirag";
	$department = $_POST['department'];
	$course_name = $_POST['course_name'];
	$course_id = $_POST['course_id'];
	$about_course = $_POST['about_course'];
	$start_semester = $_POST['start_semester'];
  $username = $_SESSION['username'];
  $last_date = $_POST['last_date'];

	$sql = "INSERT INTO courses(department, course_name, course_id, about_course, start_semester, username,last_date,seats_remaining) VALUES ('$department','$course_name','$course_id','$about_course','$start_semester', '$username', '$last_date','20' );";

	$insert_data = mysqli_query($con,$sql);

	if($insert_data)
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
    <title>Add Course</title>
    <!-- <link href="assets/css/style.css" rel="stylesheet" /> -->
</head>

<body>
	<div class="content-wrapper">
        <div class="container">

              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Student Registration  </h1>
                    </div>
              </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                          Student Registration
                        </div>

    <div class="panel-body">
    <form name="dept" method="post" enctype="multipart/form-data">

    <div class="form-group">
    	<label for="studentname">Department</label>
    	<select name="department">
	  <option value="CSE">CSE</option>
	  <option value="ECE">ECE</option>
	  <option value="EE">EE</option>
	  <option value="MnC">MnC</option>
	</select>
  	</div>

 	<div class="form-group">
    	<label for="studentregno">Course Name</label>
    	<input type="text" class="form-control" id="course_name" name="course_name"/>
  	</div>

  	<div class="form-group">
    	<label for="studentregno">Course ID</label>
    	<input type="text" class="form-control" id="course_id" name="course_id"/>
  	</div>

  	<div class="form-group">
    	<label for="studentregno">About Course</label>
    	<input type="text" class="form-control" id="about_course" name="about_course"/>
  	</div>

  	<div class="form-group">
    	<label for="studentregno">Semester</label>
    	<select name="start_semester">
			  <option value="Spring">Spring</option>
			  <option value="Fall">Fall</option>
		</select>
  	</div>

    <div class="form-group">
      <label for="studentregno">Last Date for Application</label>
      <input type="date" class="form-control" id="last_date" name="last_date"/>
    </div>

   	<button type="submit" name="submit" id="submit" class="btn btn-default">Add Course</button>

   </form>
   	</div>
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
