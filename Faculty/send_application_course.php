<?php
include("includes/config.php");
session_start();
$_SESSION['CourseID'] = $_GET['idCourse'];
$CourseID = $_SESSION['CourseID'];

if( isset($_POST["submit"]) )
{	
	$last_date = $_POST['last_date'];
	$today_date = date("Y-m-d");
	echo date("Y-m-d")."<br>";
	echo $last_date;

	if($last_date <= $today_date)
	{
		$message = "Please Check the date";
        echo "<script type='text/javascript'>alert('$message');</script>";
	}

	else
	{
		$sql = "UPDATE courses SET `last_date` = '$last_date', `Application_Status` = 'Open' WHERE `course_id` = '$CourseID';";
        $update_data = mysqli_query($con,$sql);
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
    <title>Send Applications</title>
    <!-- <link href="assets/css/style.css" rel="stylesheet" /> -->
</head>

<body>
	<form name="dept" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="studentregno">Last Date for Application</label>
      <input type="date" class="form-control" id="last_date" name="last_date"/>
    </div>

   	<button type="submit" name="submit" id="submit" class="btn btn-default">Send Application</button>

   </form>
   	</div>
   
   


   	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
</body>
</html>