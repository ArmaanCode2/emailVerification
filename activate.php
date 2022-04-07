<?php
session_start();

include 'partials/_dbconnect.php';

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $update = "UPDATE user SET status = 'active' WHERE token ='$token'";

    $result = mysqli_query($conn,$update);

    if($result){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg'] = "Your account has been Verified Successfully!";
            header('Location: login.php');
        }else{
            $_SESSION['msg'] = "Cannot Verify Your Account. Please Try Again";
            header('Location: login.php');
        }
    }else{
        $_SESSION['msg'] = "Cannot Verify Your Account. Please Try Again21";
        header('Location: signup.php');
    }
}

?>