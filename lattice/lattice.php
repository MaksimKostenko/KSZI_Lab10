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
    <title>Lattice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
</head>
<body class="background" >

<div class="container" align="center" >
    <h1>Lattice</h1><hr/>
_END;

$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connection->connect_error) die($connection->connect_error);

if (isset($_POST['username']) &&
    isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $queryUsers = "SELECT * FROM latticeusers WHERE username='$username'AND password='$password'";
    $users = $connection->query($queryUsers);
    $usersRows = $users->num_rows;
    
    if($usersRows == 0)
    {
        echo "<div align=\"left\"><h2>Error.This user does not exist.</h2>";
    }
           
    for ($j = 0 ; $j < $usersRows ; ++$j)
    {
        $users->data_seek($j);
        $userRow = $users->fetch_array(MYSQLI_ASSOC);
        $userLabel = $userRow['label'];
        
        echo "<div align=\"left\"><h2>You have access to next messages:</h2>";
        
        $queryData = "SELECT * FROM latticedata ";
        $data = $connection->query($queryData);
        $dataRows = $data->num_rows;
        for($i = 0 ; $i < $dataRows ; ++$i)
        {
            $data->data_seek($i);
            $dataRow = $data->fetch_array(MYSQLI_ASSOC);
            $dataLabel = $dataRow['label'];
            $dataid = $dataRow['id'];
            $dataMessage = $dataRow['message'];
            
            if(($userLabel >= $dataLabel) && ($userLabel%$dataLabel == 0) )
            {
                echo "<strong>Message № $dataid : $dataMessage</strong><br>";
            }
        }    
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
