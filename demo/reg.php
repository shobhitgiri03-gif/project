<?php
    $reg=$_POST['reg'];
    $host='localhost:3306';
    $db='registration';
    $username='root';
    $password=' ';
    $dsn="mysql:host=$host;dbname=$db";

    try
    {
        $conn=new PDO($dsn,$username,$password);
        if($conn)
    
        { 
            echo "Connected to the <strong>$db</strong> database successfully!"; 
        }

        $sql="delete from reg where registration_no=".$reg."";
         if ($conn->query($sql));
    {
        echo "<script type="text/javascript"> alert('Record deleted successfully!'); </script>";
    }        
    
        else
        {
            echo"<script type ="text/javascript"> alert("Error deleting record:"); </script>";
        }
    }
    catch(PDOException $e)
    {
        echo$e->getMessage();
    }
    
?>