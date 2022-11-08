<?php 
    if(empty($_SESSION)){
        session_start();
    }

$dbusername = "root";
$dbpass = "";
$ser = "localhost";
$dbname = "php_prac"; 

$conn = mysqli_connect($ser,$dbusername,$dbpass);
if( mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} 

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$result = mysqli_query($conn,"CREATE DATABASE IF NOT EXISTS $dbname");
mysqli_select_db($conn,$dbname);
$result1 = mysqli_query($conn, "CREATE TABLE IF NOT EXISTS user_data(    
    username varchar(10) not null,    
    name varchar(20) not null,    
    address varchar(50),    
    email varchar(20) not null,    
    phone bigint(10) not null,   
    password varchar(12) not null,  
    re_password varchar(12) not null,
    PRIMARY KEY(username),    
    UNIQUE(email),UNIQUE(phone) )");

    $name = $address = $email = $phone = $pass = $repass = $username="";
  
    if(isset($_POST['submit'])){

       $username = validate($_POST["username"]);
       $address = validate($_POST["address"]);  
       $name = validate($_POST["name"]);
       $email = validate($_POST["email"]);
       $phone = validate($_POST["phone"]);
       $pass = validate($_POST["password"]);
       $repass = validate($_POST["re_password"]);


        if($username==""){ 
            echo "Username cannot be empty."."<br>";
            
        }
        elseif(!preg_match("/^[a-zA-Z0-9_]*$/",$username)){
                echo "Only letters and underscore allowed."."<br>";
                       
        }

        if($name==""){
            echo "Name cannot be empty."."<br>";
            
        }
        elseif(!preg_match("/^[a-zA-Z ]*$/",$name)) {
             echo "Only letters and white space allowed."."<br>";
            
            }

        if($email==""){
            echo "Email cannot be empty."."<br>";
            
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           echo "Invalid email format."."<br>";
            
        }
            
        if($phone==""){
            echo "Phone cannot be empty."."<br>";
           
        }
        elseif(!preg_match("/^[1-9][0-9]{9}$/",$phone)){
            echo "Invalid phone format."."<br>";
      
        }

        if($pass==""|| $repass=="" || $pass!=$repass || $phone=="" || $email=="" || $name=="" || $username==""){
            echo "Error in password."."<br>";
            
        }
        else{
              $conn=new mysqli($ser,$dbusername,$dbpass,$dbname);
              $query1 = "SELECT * FROM user_data where username ='$username' OR phone =$phone OR email = '$email'";
              $result1 = $conn->query($query1);
              if(mysqli_num_rows($result1)>0){
                  while($row = mysqli_fetch_array($result1)){
                      if($row['username']==$username){
                          echo "User already exists."."<br>";
                      }
                      if($row['phone']==$phone){
                          echo "Phone already exists."."<br>";
                      }
                      if($row['email']=="$email"){
                        echo "Email already exists."."<br>";
                      }
                  }     
              }
              else{
                    $sql = "INSERT INTO user_data (username, name, address, email, phone, password,re_password ) 
                    VALUES ('$username','$name','$address','$email','$phone','$pass','$pass')";
                    if($conn->query($sql)===TRUE){                       
                        echo "Account created successfully!!";
                        $_SESSION['username'] = $username;
                        header("Location: home.php");
                    }else
                    {
                    	echo "Cannot create Account!!";
                    }
            
                 }
          }
	header("refresh: 5; index.html");
         
}
?>