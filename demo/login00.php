<?php
    $username=$_POST['username'];
    $password=$_POST['password'];

    if($username=="shobhotgiri03@gmail.com" && $password=="pandat"){
        echo "Login successful!";
    }
    else{
        echo "Invalid username or password.";
    }
 ?>
 