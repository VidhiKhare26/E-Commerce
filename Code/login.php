<?php

  session_start();
  $con = mysqli_connect('localhost', 'root', "");
  mysqli_select_db($con, 'php_prac');
  if(isset($_POST['login']))
  {

      $uName = $_POST['loginUserName'];
      $uPass = $_POST['loginPass'];

      $s = "select * from user_data where username = '$uName' && password = '$uPass'";

      $result = mysqli_query($con, $s);
      $num = mysqli_num_rows($result);

      if($num == 1)
      {
        $_SESSION['username'] = $uName;
        header("Location: home.php");
      }

      else
      {
        echo "wrong password";
        header("refresh: 5; index.html");
      }
  }

?>
