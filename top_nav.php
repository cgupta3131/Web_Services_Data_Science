<?php
if(isset($_POST["logout"])){
  session_unset();
  header("Location: ./index.php");
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Data Science, IIT Guwahati</a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mr-auto">
      </ul>
      <ul class="navbar-nav">
        <?php
            if(isset($_SESSION['login']) && $_SESSION['login'] == 1){
                echo "
                <li class='nav-item'>
                  <a class='nav-link'>
                    Welcome, {$_SESSION['FullName']}
                  </a>
                </li>


                <li class='nav-item'>
                <form method = 'post'>
                    <button type='submit' name='logout' class='nav-link btn btn-light'>Logout</button>
                    </form>
                </li>

              </ul>
                ";
            }
        else{
            echo "
            
            <li class='nav-item'>
              <a class='nav-link' href='signin.php'>
                Sign In
              </a>
            </li>
          </ul>
            ";
        }
  ?>

    </div>
  </nav>
