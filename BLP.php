<?php
require_once 'login.php';
echo <<<_END
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .background{background: linear-gradient(orangered, gold)  no-repeat;background-size: cover ;}
        html { height: 100%; }
        body {height: 100%;}
    </style>
    <meta charset="utf-8">
    <title>BellLaPadula</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
</head>
<body class="background" >

<div class="container" align="center" >
    <h1>Bell-LaPadula</h1><hr/>
_END;

$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connection->connect_error) die($connection->connect_error);

if (isset($_POST['username']) &&
    isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM `users` WHERE username='$username'AND password='$password'";
    $result = $connection->query($query);

     $rows = $result->num_rows;

    for ($j = 0 ; $j < $rows ; ++$j)
    {
        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $level = $row['level'];
    }

}
$connection->close();

echo <<<_END
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
_END;

