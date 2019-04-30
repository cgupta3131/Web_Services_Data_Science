<?php
include("includes/config.php");
session_start();
$_SESSION['username'] = "cgupta3131@gmail.com";
$username = $_SESSION['username'];

$sql=mysqli_query($con,"select * from courses WHERE Application_Status = 'Open' ");
while($row = mysqli_fetch_array($sql))
{
	$courseId = $row['course_id'];
	$FacultyName = $row['username'];
	if( isset($_POST[$courseId]) )
	{
		$temp = "Select * from applicant WHERE `email` = '$username' ";
		$retrieve_data = mysqli_query($con, $temp);

		while($row2 = mysqli_fetch_array($retrieve_data))
		{
			$gateScore = $row2['gatescore'];

			$sql2 = "INSERT INTO RequestCourse(courseID, UserName, FacultyName, gateScore, CPI) 
				VALUES ('$courseId','$username','$FacultyName','$gateScore','0');";

			$insert_data = mysqli_query($con,$sql2);
		}
		
	}
}

?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Select Course</title>
</head>

<body>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive table-bordered">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Course ID</th>
                        <th>Semester</th>
                        <th>Course Name</th>
                        <th>Last Date for Application</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $_SESSION['username'] = "cgupta3131@gmail.com";
  				$username = $_SESSION['username'];

                $sql=mysqli_query($con,"select * from courses WHERE Application_Status = 'Open'");
                $cnt=1;

                while($row = mysqli_fetch_array($sql))
                {
					$today_date = date("Y-m-d");
					$courseID = $row['course_id'];

					if($row['last_date'] < $today_date)
					{
						$sql2 = "UPDATE courses SET `Application_Status` = 'Deadline Passed' WHERE `course_id` = '$courseID';";
             			$update_data = mysqli_query($con,$sql2);
						continue;
					}
				?>
                    <tr>

                        <td><?php echo $cnt;?></td>
                        <td><?php echo htmlentities($row['course_id']);?></td>
                        <td><?php echo htmlentities($row['start_semester']);?></td>
                        <td><?php echo htmlentities($row['course_name']);?></td>
                        <td><?php echo htmlentities($row['last_date']);?></td>
                        <td>

                        <a href="../Faculty/view_individual_course.php?idCourse=<?php echo $row['course_id']?>">
                        
                        <button class="btn btn-primary"><i class="fa fa-edit "></i>View</button> </a>     
						<form name="dept" method="post" enctype="multipart/form-data">

                        <button type="submit" name="<?php echo $row['course_id']?>" class="btn btn-default">Request Register For Course</button>
                    	</form>

                        </td>
                    </tr>
                    <?php 
                    $cnt++;
                } ?>

                    
                </tbody>
                
            </table>
        </div>
    </div>

</body>
</html>  