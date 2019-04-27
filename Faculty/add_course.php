<?php
include("includes/config.php");

if( isset($_POST["submit"]) )
{

	$department = $_POST['department'];
	$course_name = $_POST['course_name'];
	$course_id = $_POST['course_id'];
	$about_course = $_POST['about_course'];
	$start_semester = $_POST['start_semester'];

	$sql = "INSERT INTO courses(department, course_name, course_id, about_course, start_semester) VALUES ('$department','$course_name','$course_id','$about_course','$start_semester');";
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

   	<button type="submit" name="submit" id="submit" class="btn btn-default">Add Course</button>

   </form>
   	</div>
</body>
</html>
