<?php

$userid = $_POST["id"] ?? "";
$oldpassword = $_POST["password"] ?? "";
$newpassword = $_POST["newpassword"] ?? "";
$confirmnewpassword = $_POST["confirmpassword"] ?? "";

$host = "localhost";
$db = "logbase";
$username = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$db";

try
{
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connection to <strong>$db</strong> database is successful.<br><br>";

    // Check old password
    $sql = "SELECT * FROM logtable WHERE userid=? AND password=?";
    $statement = $conn->prepare($sql);
    $statement->execute([$userid, $oldpassword]);

    if($statement->rowCount() > 0)
    {
        if($newpassword == $confirmnewpassword)
        {
            $updateSql = "UPDATE logtable SET password=? WHERE userid=?";
            $updateStatement = $conn->prepare($updateSql);

            if($updateStatement->execute([$newpassword, $userid]))
            {
                echo "Password updated successfully.";
            }
            else
            {
                echo "Error updating password.";
            }
        }
        else
        {
            echo "New password and Confirm password do not match.";
        }
    }
    else
    {
        echo "Old password is incorrect.";
    }

}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

?>