<?php
include("includes/config.php");
session_start();
$_SESSION['CourseID'] = $_GET['idCourse'];

?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Students</title>
</head>

<body>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive table-bordered">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Grade</th>
                    </tr>
                </thead>


                <tbody>
                <?php
                $courseID = $_SESSION['CourseID'];
                $sql=mysqli_query($con,"select * from EnrolledStudents WHERE `courseID` = '$courseID'");
                $cnt=1;
                while($row = mysqli_fetch_array($sql))
                {
                ?>
                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo htmlentities($row['Username']);?></td>
                        <td><?php echo htmlentities($row['Grade']);?></td>
                    
                        <?php
                            $username_student = $row['Username'];
                            $sql2=mysqli_query($con,"select * from applicant WHERE `email` = '$username_student'");
                            
                            while($row2 = mysqli_fetch_array($sql2))
                            { ?>
                                <td><?php echo htmlentities($row2['name']);?></td>
                            }
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