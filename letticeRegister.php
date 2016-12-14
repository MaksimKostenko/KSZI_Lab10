<?php
require_once 'login.php';
$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connection->connect_error) die($connection->connect_error);

if (isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['label']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $label = $_POST['label'];

    $query = "INSERT INTO `latticeusers` (`username`, `password`, `label`) VALUES ('$username', '$password', '$label');";
    $result = $connection->query($query);
}

$connection->close();
echo "User was added!";



