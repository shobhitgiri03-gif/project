<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
</head>
<body>

<?php
$id = $_REQUEST["ID"] ?? "";
echo $id;
?>

<form action="updateprocess.php" method="post">
    <table border="1" cellpadding="5">
        <tr>
            <td>ID</td>
            <td>
                <input type="text" name="id" value="<?php echo htmlspecialchars($id); ?>" readonly>
            </td>
        </tr>

        <tr>
            <td>Current Password</td>
            <td>
                <input type="password" name="password" required>
            </td>
        </tr>

        <tr>
            <td>New Password</td>
            <td>
                <input type="password" name="newpassword" required>
            </td>
        </tr>

        <tr>
            <td>Confirm Password</td>
            <td>
                <input type="password" name="confirmpassword" required>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <input type="submit" name="update" value="Update">
            </td>
        </tr>
    </table>
</form>

</body>
</html>