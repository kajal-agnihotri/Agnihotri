<?php
session_start();
error_reporting(1);
class web
{
  public $conn;
  function __construct()
  {
    $this->conn = new mysqli("localhost", "root", "", "assessment_database");
    if ($this->conn->error) {
      echo "we got an error";
    }
  }
  function register()
  {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = md5($_POST['password']);
    $created_on = $_POST['created_on'];
    $last_login_ip = $_SERVER['REMOTE_ADDR'];

    $user = $this->conn->query("SELECT * FROM assdt_users WHERE mobile_number = '$phone' or email_id='$email'");
    if (mysqli_num_rows($user) > 0) {
      $data = $user->fetch_assoc();
       
      echo "Email and mobile number Has Already Taken" . "<br>";

      if (strlen($password) > 8) {
        echo "Password length should be 8 charachter long.";
      }
    } else {
            $this->conn->query("INSERT INTO assdt_users(`full_name`,`email_id`, `mobile_number`,`password`,`created_on`,`last_login_ip`)VALUES ('$name', '$email', '$phone', '$password', '$created_on','$last_login_ip')");
      echo "Registration Successful";
    }
  }
  function login()
  {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $user = $this->conn->query("select * from assdt_users where email_id='$email' or password='$password'");

    if ($user->num_rows > 0){
      $row = $user->fetch_assoc();
      if ($password = $row['password']) {
        $_SESSION['email'] = $row['email'];
        $_SESSION['id'] = $row['id'];  
        echo "Login Successful";
      } else {
        echo "password does not matched";
      }
    } else{

      echo "user not registered";
    }
  }
  
}
