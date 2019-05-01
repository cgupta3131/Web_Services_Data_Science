<?php
include("includes/config.php");
session_start();
$_SESSION['username'] = "chirag";
$username = $_SESSION['username'];

$sql=mysqli_query($con,"select * from courses WHERE `username` = '$username' AND `Application_Status` = 'Open' OR `Application_Status` = 'Deadline Passed' ");

while($row = mysqli_fetch_array($sql))
{
	$courseId = $row['course_id'];
	if( isset($_POST[$courseId]) )
	{
		echo "Chirag";
		$sql2=mysqli_query($con,"select * from RequestCourse WHERE `courseID` = '$courseId' ORDER BY `gateScore` DESC");
		$j = 0;
		while($row2 = mysqli_fetch_array($sql2))
		{
			if($j > 20)
				break;
			$j += 1;
			$student_username = $row2['UserName'];
			$sql = "INSERT INTO EnrolledStudents(CourseID, Username) 
					VALUES ('$courseId','$student_username');";

			$insert_data = mysqli_query($con,$sql);
		}

		$sql3 = "UPDATE courses SET `Application_Status` = 'Completed' WHERE `course_id` = '$courseId';";
        $update_data = mysqli_query($con,$sql3);
	}
}


?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Request Courses</title>
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
                        <th> Application Status </th>
                        <th> Last Date </th>
                         <th>Action</th>
                    </tr>
                </thead>


                <tbody>
                <?php
                

                $sql=mysqli_query($con,"select * from courses WHERE `username` = '$username' AND `Application_Status` = 'Open' OR `Application_Status` = 'Deadline Passed' ");
                $cnt=1;
                while($row = mysqli_fetch_array($sql))
                {
                ?>

                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo htmlentities($row['course_id']);?></td>
                        <td><?php echo htmlentities($row['start_semester']);?></td>
                        <td><?php echo htmlentities($row['Application_Status']);?></td>
                        <td><?php echo htmlentities($row['last_date']);?></td>
                        <td>
                            
                        <form method="post">
                        <a href="view_students.php?idCourse=<?php echo $row['course_id']?>">
                        <button class="btn btn-primary"><i class="fa fa-edit "></i>View Students</button> </a>     
                        
                        <button type="submit" name="<?php echo $row['course_id']?>" class="btn btn-default">Register Students</button>
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