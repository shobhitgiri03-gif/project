<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table border="1">
    <tr>
        <td> userid </td>
        <td> password </td>
    </tr>
    
<?php
$id = $_REQUEST["ID"] ?? "";   

$host = "localhost";
$db = "logbase";
$username = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$db";

try
{
    $conn = new PDO($dsn, $username, $password);

    if($conn)
    {
        echo "Connection to the <strong>$db</strong> database is successful.<br><br>";
    }

    $sql = "SELECT * FROM tablelog WHERE userid='$id'";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $row = $statement->fetch();

    if($row)
    {
?>
        <tr>
            <td><?php echo $row["userid"]; ?></td>
            <td><?php echo $row["password"]; ?></td>
        </tr>
<?php
    }
    else
    {
        echo "<tr><td colspan='2'>No Record Found</td></tr>";
    }
}
catch(PDOException $e)
{
    echo "Connection failed : " . $e->getMessage();
}
?>

</table>

</body>
</html>