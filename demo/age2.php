<?php
    $age=$_POST['age'];
    if($age>=18)
    {
        echo "You are eligible for vote";
    }
    else
    {
        echo "You are not eligible for vote";
    }
?>