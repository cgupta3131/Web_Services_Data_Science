<?php
include("includes/config.php");
session_start();
$_SESSION['username'] = "chirag";
$username = $_SESSION['username'];


?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>My Students</title>
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
                

                $sql=mysqli_query($con,"select * from courses WHERE `username` = '$username' AND `Application_Status` = 'Completed' ");
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

                        <a href="view_registered_students.php?idCourse=<?php echo $row['course_id']?>">
                        <button class="btn btn-primary"><i class="fa fa-edit "></i>View Students</button> </a>     

                        
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