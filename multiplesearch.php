<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Records</title>
    <link href="bootstrap.css" rel="stylesheet">
</head>
<body>

<table border="1" class="table table-bordered">
    <tr>
        <th>User ID</th>
        <th>Password</th>
        <th>Delete</th>
        <th>Update</th>
        <th>View</th>
    </tr>

<?php
$host = "localhost";
$db = "logbase";
$username = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$db";

try
{
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connection to <b>$db</b> database successful.<br><br>";

    $sql = "SELECT * FROM logtable";
    $statement = $conn->prepare($sql);
    $statement->execute();

    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
?>
    <tr>
        <td><?php echo $row['userid']; ?></td>
        <td><?php echo $row['password']; ?></td>

        <td>
            <a href="delete.php?ID=<?php echo $row['userid']; ?>">
                <button class="btn btn-danger btn-sm">Delete</button>
            </a>
        </td>

        <td>
            <a href="update.php?ID=<?php echo $row['userid']; ?>">
                <button class="btn btn-warning btn-sm">Update</button>
            </a>
        </td>

        <td>
            <a href="viewdirct.php?ID=<?php echo $row['userid']; ?>">
                <button class="btn btn-primary btn-sm">View</button>
            </a>
        </td>
    </tr>

<?php
    }
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>

</table>

</body>
</html>