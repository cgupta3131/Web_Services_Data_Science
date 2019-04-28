<?php
include("includes/config.php");
session_start();

?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>My Project</title>
</head>

<body>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Course  </h1>
                    </div>
                </div>

                <div class="row" >
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Course
                        </div>
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
                                             <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                    <?php

                                    $sql=mysqli_query($con,"select * from courses WHERE `username` = 'chirag' ");
                                    $cnt=1;
                                    while($row = mysqli_fetch_array($sql))
                                    {
                                    ?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['course_id']);?></td>
                                            <td><?php echo htmlentities($row['start_semester']);?></td>
                                            <td><?php echo htmlentities($row['course_name']);?></td>
                                            <td>

                                            <a href="view_individual_course.php?idCourse=<?php echo $row['course_id']?>">
                                            
                                            <button class="btn btn-primary"><i class="fa fa-edit "></i>View</button> </a>     

                                            <a href="edit_individual_course.php?idCourse=<?php echo $row['course_id']?>">
                                            <button class="btn btn-danger">Edit</button>    
                                            </a>

                                            <a href="send_application_course.php?idCourse=<?php echo $row['course_id']?>">
                                            <button type="submit" name="submit" id="submit" class="btn btn-default">Send Applications</button>
                                            </a>


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
</body>
</html>    


