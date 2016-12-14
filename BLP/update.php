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

if (isset($_POST['message1']))
{
    $text = $_POST['message1'];
    $updateQuery = "UPDATE bell SET message = '$text' WHERE bell.level = 1";
    $update = $connection->query($updateQuery);
    echo "<div align=\"left\"><h2>Message № 1 was changed successful</h2>";
    echo "<div class=\"form_group\" align=\"left\"><form action='BellLaPadula.html'>"
        ."<input class=\"btn btn-primary\" type=\"submit\" value=\"Back\"></form></div>";
}
elseif (isset($_POST['message2']))
{
    $text = $_POST['message2'];
    $updateQuery = "UPDATE bell SET message = '$text' WHERE bell.level = 2";
    $update = $connection->query($updateQuery);
    echo "<div align=\"left\"><h2>Message № 2 was changed successful</h2>";
    echo "<div class=\"form_group\" align=\"left\"><form action='BellLaPadula.html'>"
        ."<input class=\"btn btn-primary\" type=\"submit\" value=\"Back\"></form></div>";
}
elseif (isset($_POST['message3']))
{
    $text = $_POST['message3'];
    $updateQuery = "UPDATE bell SET message = '$text' WHERE bell.level = 3";
    $update = $connection->query($updateQuery);
    echo "<div align=\"left\"><h2>Message № 3 was changed successful</h2>";
    echo "<div class=\"form_group\" align=\"left\"><form action='BellLaPadula.html'>"
        ."<input class=\"btn btn-primary\" type=\"submit\" value=\"Back\"></form></div>";
}

$connection->close();

echo <<<_END
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
_END;
