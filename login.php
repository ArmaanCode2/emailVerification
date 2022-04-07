<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
session_start();
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
include 'partials/_dbconnect.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


    // $sql ="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $sql ="SELECT * FROM `user` WHERE username = '$username' AND email = '$email' AND status = 'active'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
        while($row=mysqli_fetch_assoc($result)){
          if(password_verify($password,$row['password'])){
            $login = true;
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("location: welcome.php");
          }else{
            $showError = "Invalid Credentials";
            }
        }
    }else{
    $showError = "Invalid Credentials";
    }       
}
?>
    <?php   require 'partials/_nav.php';   ?>
    <?php
    if($login){
        echo'
        <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success! </strong> You Are Logged in
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if($showError){
        echo'
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error </strong> '. $showError.'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <div class="container my-4">
        <h1 class="text-center">log in To Continue</h1>
        <form action="/emailvef/login.php" method="post">
  <div class="mb-3">
    <?php 
    if(isset($_SESSION['msg'])){
      echo ' <p>' . $_SESSION['msg'] . '</p>';
    }
    ?>
    <label for="username" class="form-label">Username</label>
    <input maxlength="11" name="username"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input maxlength="23" type="password" name="password"class="form-control" id="exampleInputPassword1">
  </div>

  <button type="submit" class="btn btn-primary">log in</button>
</form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>