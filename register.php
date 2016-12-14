<?php
require_once 'login.php';
$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connection->connect_error) die($connection->connect_error);

if (isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['level']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $query = "INSERT INTO `users` (`username`, `password`, `level`) VALUES ('$username', '$password', '$level');";
    $result = $connection->query($query);
}

$connection->close();
echo "User was added!";

