<?php
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === "admin" && $password === "admin123") {
    header("Location: welcome.php?ID=" . urlencode($username));
    exit();
} else {
    header("Location: worng.php");
    exit();
}
?>


