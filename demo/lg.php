<?php
    $email=$_POST['email'];
    $password=$_POST['password'];

    if($email=="shobhitgiri03@gmail.com" && $password=="shobhit123"){
        echo "<a href='login2.html'>Login successful!</a>";
    }
    else{
        echo "<a href='login3.html'>Invalid email or password.</a>";
    }
 ?>
 