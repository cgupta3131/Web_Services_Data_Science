<?php
include("includes/config.php");
session_start();

if(isset($_POST["submit"]))
{
	$query = mysqli_query($con, "SELECT * FROM courses");
    $i = 0;
    while($row = mysqli_fetch_assoc($query))
        $i += 1;

 	$total_count = $i*20;
 	//echo "Total rows: " . $total_count;

    $query = mysqli_query($con, "SELECT * FROM applicant ORDER BY gatescore DESC");

    $j = 0;
    while($row = mysqli_fetch_assoc($query))
    {
    	if($j > $total_count)
    		break;

        $j += 1;
        $suffix;
        if(strlen($j) == 1)
        	$suffix = "00".$j;
        if(strlen($j) == 2)
        	$suffix = "0".$j;
        if(strlen($j) == 3)
        	$suffix = $j;


        $email_id = $row['email'];
        $full_name = $row['name'];
        $non_hashed_passwd = randomPassword();
        $password = md5($non_hashed_passwd);
        $RollNumber = date("y")."0101".$suffix;
        
        echo $RollNumber."<br>";

        //Making selected as True
        $sql = "UPDATE applicant SET `selected` = 'True' WHERE `email` = '$email_id';";
    	$update_data = mysqli_query($con,$sql);

    	//Registering Student
    	$sql = "INSERT INTO Users(Username, Password, RollNumber, FullName, Designation) 
                    VALUES ('$email_id','$password','$RollNumber','$full_name', 'Student' );";
    	$insert_data = mysqli_query($con,$sql);
    }


}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<?php
    $query = mysqli_query($con, "SELECT * FROM applicant");

    $bgcolor = array('bg-success', 'bg-danger', 'bg-warning', 'bg-info');

    $i = 0;
    while($row = mysqli_fetch_assoc($query))
    {
        echo "<div class='card text-white {$bgcolor[$i%4]} mb-3 pull-left col-height col-middle col-xs-5' style='max-width: 100rem;'>
                <h5 class='card-header'>{$row['name']}</h5>
                  <div class='card-body'>
                    <p class='card-text'>{$row['email']}</p>
                  </div>	
              </div>";
        $i += 1;
    }   
  ?>

  <form method="post">
  <button type="submit" name="submit" class="btn btn-primary">Approve Applicants</button>
  </form>


	
</body>
</html>