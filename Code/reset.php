<?php

  session_start();
  $con = mysqli_connect('localhost', 'root', "");
  mysqli_select_db($con, 'php_prac');
 if(isset($_POST['login']))
  {
      $uName = $_POST['loginUserName'];
      $currPass = $_POST['currentPass'];
      $newPass = $_POST['newPass'];
      $renewPass = $_POST['renewPass'];

      if($newPass != $renewPass)
      {
        echo "<h1>New Password is not same as Re-entered New Password. Can't update password</h1><br>";
        header("refresh: 5; index.html");
      }

      if($currPass == $newPass)
      {
        echo "<h1>New Password cannot be same as Current Password. Can't update password</h1><br>";
        header("refresh: 5; index.html");
      }

      $s = "select * from user_data where username = '$uName' && password = '$currPass'";

      $result = mysqli_query($con, $s);
      $num = mysqli_num_rows($result);

      if($num == 1)
      {
        $s = "update user_data set password = '$newPass', re_password = '$renewPass' where username = '$uName'";
        $result = mysqli_query($con, $s);
        if($result)
         {

          echo "Password updated succefully";
          header("refresh: 5; index.html");
         }
      }

      else
      {
        echo "<h1>Wrong Credentials are entered! Can't update password</h1>";
        header("refresh: 5; index.html");

      }
    }
      session_destroy();
?>
