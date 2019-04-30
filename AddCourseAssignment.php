<?php
if(!(isset($_SESSION['login']) && $_SESSION['login'] == 1)){
    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://{$host}/Web_Services_Data_Science");
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
      </ul>
    </div>
  </nav>

  <?php
    session_start();
    include("config.php");

    // $CourseID = $_SESSION['CourseID'];

    if(isset($_POST["submit"])){
      $AssignmentID = $_POST['AssignmentID'];
      $Details = $_POST['Details'];
      $Deadline = $_POST['Deadline'];
      $CourseID = $_SESSION['CourseID'];

      $IsUpload = True;

      // $target_dir = "/opt/lampp/htdocs/Web_Services_Data_Science/media/courses/$CourseID/assignments/$AssignmentID/";
      $target_course_dir = "/opt/lampp/htdocs/Web_Services_Data_Science/media/courses/$CourseID";
      $target_dir = "/opt/lampp/htdocs/Web_Services_Data_Science/media/courses/$CourseID/assignments/$AssignmentID/";
      $target_file = $target_dir . basename($_FILES["AssignmentFile"]["name"]);
      // echo "<script type='text/javascript'>alert('$target_file');</script>";

      if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $IsUpload = False;
      }

      if($IsUpload == True){
        if(!is_dir("$target_course_dir")) {
          mkdir("$target_course_dir");
        }

        if(!is_dir("$target_course_dir/assignments")) {
          mkdir("$target_course_dir/assignments");
        }

        if(!is_dir("$target_dir")) {
          mkdir("$target_dir");
        }

        if (move_uploaded_file($_FILES["AssignmentFile"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["AssignmentFile"]["name"]). " has been uploaded.";
          $query = mysqli_query($connection, "INSERT into CourseAssignments(CourseID, AssignmentID, Details, Deadline, AssignmentFile) values('$CourseID', '$AssignmentID', '$Details', '$Deadline', '$target_file')");
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      }


    }
  ?>

  <form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label>Assignment ID</label>
    <input type="text" class="form-control" name="AssignmentID" placeholder="Assignment ID" required>
  </div>
  <div class="form-group">
    <label>Details</label>
    <textarea rows="5" class="form-control" name="Details" placeholder="Details of the assignment" required></textarea>
  </div>
  <div class="form-group">
    <label>Deadline</label>
    <input type="datetime-local" class="form-control" name="Deadline" placeholder="Deadline" required>
  </div>
  <div class="custom-file">
    <input type="file" class="custom-file-input" name="AssignmentFile">
    <label class="custom-file-label">Upload assignment</label>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Sign In</button>
</form>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
