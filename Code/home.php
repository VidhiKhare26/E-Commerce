<?php
  session_start();

  if(!isset($_SESSION['username']))
  {
    header('location:  index.html');
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  </head>
  <body>    
        <div class="container">  
      
          <h1 style="color:white;" >Welcome <?php echo $_SESSION['username']?></h1>
          <a  href="logout.php" class="btn btn-primary">Logout</a>
          <a  href="reset.html" class="btn btn-primary">Reset password</a>

        </div>
  
  </body>
</html>
